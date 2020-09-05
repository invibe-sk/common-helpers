<?php


namespace Invibe\CommonHelpers;

/**
 * Class Helpers
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers
 */
class TinyMceConfig
{
    /**
     * @param int $height
     * @return array
     * @author Adam Ondrejkovic
     */
    public function longTextConfig(int $height = 800) : array
    {
        return [
            'toolbar' => 'undo redo | bold italic underline strikethrough | formatselect | image | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist |',
            'block_formats' => 'Odstavec=p; Nadpis 1=h2; Nadpis 2=h3; Nadpis 3=h4;',
            'image_advtab' => true,
            'height' => $height,
            'menubar' => '',
        ];
    }

    /**
     * @param int $height
     * @return array
     * @author Adam Ondrejkovic
     */
    public function regularTextConfig(int $height = 400) : array
    {
        return [
            'toolbar' => 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist',
            'height' => $height,
            'menubar' => '',
        ];
    }
}