<?php
/**
 * @author Adam Ondrejkovic
 * Created by PhpStorm.
 * Date: 01/06/2020
 * Time: 21:14
 */

namespace Invibe\CommonHelpers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommonFilters
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers
 */
class CommonFilters {

    /**
     * @param string|null $createdName
     * @param string|null $updatedName
     * @author Adam Ondrejkovic
     */
    public static function createdUpdatedFilters(string $createdName = null, string $updatedName = null)
    {
        self::createdFilter($createdName);
        self::updatedFilter($updatedName);
    }

    /**
     * @param string|null $updatedName
     * @author Adam Ondrejkovic
     */
    public static function updatedFilter(string $updatedName = null)
    {
        // daterange filter
        CRUD::addFilter([
            'type'  => 'date_range_localized',
            'name'  => 'updated_at',
            'label' => $updatedName ?? 'Upravený',
        ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'updated_at', '>=', $dates->from . ' 00:00:00');
                $this->crud->addClause('where', 'updated_at', '<=', $dates->to . ' 23:59:59');
            });
    }

    /**
     * @param string|null $createdName
     * @author Adam Ondrejkovic
     */
    public static function createdFilter(string $createdName = null)
    {
        // daterange filter
        CRUD::addFilter([
            'type'  => 'date_range_localized',
            'name'  => 'created_at',
            'label' => $createdName ?? 'Vytvorený',
        ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'created_at', '>=', $dates->from . ' 00:00:00');
                $this->crud->addClause('where', 'created_at', '<=', $dates->to . ' 23:59:59');
            });
    }

    /**
     * @param array $names
     * @author Adam Ondrejkovic
     */
    public static function activeFilter(array $names = [])
    {
        CRUD::addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Status'
        ], [
            1 => $names['active'] ?? 'Aktívne',
            0 => $names['inactive'] ?? 'Neaktívne',
        ], function($value) {
            $this->crud->addClause('where', 'active', $value);
        });
    }
}
