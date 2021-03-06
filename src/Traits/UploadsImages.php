<?php


namespace Invibe\CommonHelpers\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManagerStatic as Image;
use Invibe\CommonHelpers\Jobs\OptimizeImage;
use Invibe\CommonHelpers\MimeTypes;
use Throwable;

/**
 * Trait UploadsImages
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Traits
 */
trait UploadsImages
{
    abstract protected function getImageUrlDisk() : string;

    /**
     * @return string
     * @author Adam Ondrejkovic
     */
    public function getDefaultImageUrl() : string
    {
        return "https://dummyimage.com/500x500";
    }

    /**
     * @param $image
     * @param bool $webp
     * @return string
     * @author Adam Ondrejkovic
     */
    public function getImageUrl($image, bool $webp = false) : string
    {
        if ($this->{$image}) {
            $filename = $webp ? webpFileName($this->{$image}) : $this->{$image};
            return Storage::disk($this->getImageUrlDisk())->url($filename);
        } else {
            return $this->getDefaultImageUrl();
        }
    }

    /**
     * @param $image
     * @return mixed|string
     * @author Adam Ondrejkovic
     */
    public function getImageExt($image)
    {
        return explode(".", $this->{$image})[1] ?? null;
    }

    /**
     * @param string|null $value
     * @param string $attributeName
     * @param int|null $width
     * @param int|null $height
     * @return $this
     * @author Adam Ondrejkovic
     */
    public function uploadImage(string $attributeName, string $value = null, int $width = null, int $height = null)
    {
        $disk = $this->getImageUrlDisk();

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            Storage::disk($disk)->delete($this->{$attributeName});
            Storage::disk($disk)->delete(webpFileName($this->{$attributeName}));

            // set null in the database column
            $this->attributes[$attributeName] = null;
        } else if (Str::startsWith($value, 'data:image')) {
            $compressedFileName = $this->uploadAndCompressImage($value, $width, $height);

            // Delete the previous image, if there was one.
            Storage::disk($disk)->delete($this->{$attributeName});
            Storage::disk($disk)->delete(webpFileName($this->{$attributeName}));

            // Set attr
            $this->attributes[$attributeName] = $compressedFileName;
        } else {

            if (Str::contains($value, "/")) {
                $exploded = explode("/", $value);
                $value = end($exploded);
            }

            $this->attributes[$attributeName] = $value;
        }

        return $this;
    }

    /**
     * @param $value
     * @param null $width
     * @param null $height
     * @return string
     * @author Adam Ondrejkovic
     */
    public function uploadAndCompressImage($value, $width = null, $height = null)
    {
        // Make the image
        $image = Image::make($value);

        // Get extension
        $mimes = new MimeTypes();
        $ext = $mimes->getExtension($image->mime);

        // Generate a filename.
        $filename = md5($value.time()).".{$ext}";

        // Store the image on disk.
        Storage::disk($this->getImageUrlDisk())->put($filename, $image->stream());

        // Compress image and get compressed file name
        return $this->compressImage($value, $filename, $width, $height);
    }

    /**
     * @param string $value
     * @param string $filename
     * @param int|null $width
     * @param int|null $height
     * @return string
     * @author Adam Ondrejkovic
     */
    public function compressImage(string $value, string $filename, int $width = null, int $height = null)
    {

        // Get compressed filename
        $ext = explode(".", $filename)[1];
        $disk = $this->getImageUrlDisk();
        $name = md5($value.time().time());

        $compressedFileName = "c_{$name}.{$ext}";

        Storage::disk($disk)->move($filename, $compressedFileName);

        Image::make(Storage::disk($disk)->path($compressedFileName))
            ->resize(($width ?? 1200), ($height ?? 1200), function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(Storage::disk($disk)->path($compressedFileName));

        if (config('common-helpers.use_tinyfy')) {
            OptimizeImage::dispatch($compressedFileName, $this->getImageUrlDisk());
        }

        createWebpVariant($disk, $compressedFileName);

        // Delete uncompressed image if there is any
        Storage::disk($disk)->delete($filename);

        return $compressedFileName;
    }

    /**
     * @param string $image
     * @param string|null $name
     * @param array $attributes
     * @return array|string
     * @throws Throwable
     * @author Adam Ondrejkovic
     */
    public function getImageElement(string $image, string $name = null, array $attributes = [])
    {
        return view('common-helpers::image-element', [
            'image' => $image,
            'name' => $name,
            'model' => $this,
            'attributes' => $attributes,
        ])->render();
    }

    /**
     * @param $image
     * @return array|string
     * @throws Throwable
     * @author Adam Ondrejkovic
     */
    public function getAdminImageElement($image)
    {
        $image = $this->getImageUrl($image);
        return view('common-helpers::admin-image-element', compact('image'))->render();
    }
}
