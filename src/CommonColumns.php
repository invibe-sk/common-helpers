<?php


namespace Invibe\CommonHelpers;

/**
 * Class CommonColumns
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers
 */
class CommonColumns
{
    /**
     * @param string $name
     * @return string[]
     * @author Adam Ondrejkovic
     */
    public static function createdAtColumn(string $name = "Vytvorená") : array
    {
        return [
            [
                'name'  => 'created_at',
                'label' => $name,
                'type'  => 'datetime',
            ],
        ];
    }

    /**
     * @param string $name
     * @return string[]
     * @author Adam Ondrejkovic
     */
    public static function updatedAtColumn(string $name = "Upravená") : array
    {
        return [
            [
                'name'  => 'updated_at',
                'label' => $name,
                'type'  => 'datetime',
            ],
        ];
    }

    /**
     * @param string $name
     * @return string[]
     * @author Adam Ondrejkovic
     */
    public static function activeColumn(string $name = "Aktívna") : array
    {
        return [
            [
                'name' => 'active',
                'type' => 'check',
                'label' => $name,
            ],
        ];
    }

    /**
     * @param string $name
     * @return string[]
     * @author Adam Ondrejkovic
     */
    public static function nameColumn(string $name = "Názov") : array
    {
        return [
            [
                'name' => 'name',
                'type' => 'text',
                'label' => $name,
            ],
        ];
    }

    /**
     * @param string $name
     * @return array[]
     * @author Adam Ondrejkovic
     */
    public static function imageColumn(string $name = '') : array
    {
        return [
            [
                'name' => $name,
                'type' => 'model_function',
                'label' => '',
                'function_name' => 'getAdminImageElement',
                'function_parameters' => ['image'],
                'limit' => 1000,
            ]
        ];
    }
}
