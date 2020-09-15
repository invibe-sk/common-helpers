<?php
/**
 * @author Adam Ondrejkovic
 * Created by PhpStorm.
 * Date: 01/06/2020
 * Time: 21:14
 */

namespace Invibe\CommonHelpers\Traits;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Trait CommonFilters
 * @author Adam Ondrejkovic
 * @package App\Traits\Admin
 */
trait CommonFilters {

    /**
     * @param null $createdName
     * @param null $updatedName
     * @author Adam Ondrejkovic
     */
    public function createdUpdatedFilters($createdName = null, $updatedName = null)
    {
        $this->createdFilter($createdName);
        $this->updatedFilter($updatedName);
    }

    /**
     * @param string $updatedName
     * @author Adam Ondrejkovic
     */
    public function updatedFilter($updatedName = "Upravený")
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
     * @param string $createdName
     * @author Adam Ondrejkovic
     */
    public function createdFilter($createdName = "Vytvorený")
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
     * @author Adam Ondrejkovic
     */
    public function activeFilter()
    {
        $this->crud->addFilter([
            'name'  => 'active',
            'type'  => 'dropdown',
            'label' => 'Status'
        ], [
            1 => 'Aktívne',
            0 => 'Neaktívne',
        ], function($value) { // if the filter is active
            $this->crud->addClause('where', 'active', $value);
        });
    }
}
