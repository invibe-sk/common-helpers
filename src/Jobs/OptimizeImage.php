<?php


namespace Invibe\CommonHelpers\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use function Tinify\fromFile;
use function Tinify\setKey;

/**
 * Class OptimizeImage
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Jobs
 */
class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filename, $disk;

    /**
     * OptimizeImage constructor.
     * @param string $filename
     * @param string $disk
     */
    public function __construct(string $filename, string $disk)
    {
        $this->filename = $filename;
        $this->disk = $disk;
    }

    /**
     * @author Adam Ondrejkovic
     */
    public function handle()
    {
        // Set tinyfy key
        setKey(config('common-helpers.tinyfy_api_key'));

        // Load compressed tinyfy file from filename
        $compressedImage = fromFile(Storage::disk($this->disk)->path($this->filename));

        // Resize compressed tinyfy file to fit the resolution provided
        $resizedCompressedImage = $compressedImage->resize([
            "method" => "fit",
            "width" => $width ?? 1200,
            "height" => $height ?? 1200,
        ]);

        // Store compressed image to file
        $resizedCompressedImage->toFile(Storage::disk($this->disk)->path($this->filename));

        Log::info("Job ran");
    }
}
