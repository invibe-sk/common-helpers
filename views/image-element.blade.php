<picture>
    <source srcset="{{ $model->getImageUrl($image, true) }}" type="image/webp">
    <source srcset="{{ $model->getImageUrl($image) }}" type="image/{{ $model->getImageExt($image) }}">
    <img
        loading="lazy"
        src="{{ $model->getImageUrl($image) }}"
        alt="{{ ($name ?? $model->name) ?? "" }}"
        @foreach($attributes ?? [] as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach
    >
</picture>