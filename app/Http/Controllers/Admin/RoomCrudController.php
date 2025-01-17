<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoomRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RoomCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RoomCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Room::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/room');
        CRUD::setEntityNameStrings('room', 'rooms');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column([
            'name'        => 'room_number',
            'label'       => 'Room Number',
            'type'        => 'text'
        ]);

        CRUD::column([
            'name'        => 'price_per_night',
            'label'       => 'Price Per Night',
            'type'        => 'number'
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['available' => 'Available', 'occupied' => 'Occupied','maintenance' => 'Maintenance'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['single' => 'Single', 'double' => 'Double','suite' => 'Suite'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'name'        => 'room_number',
            'label'       => 'Room Number',
            'type'        => 'text'
        ]);

        CRUD::column([
            'name'        => 'price_per_night',
            'label'       => 'Price Per Night',
            'type'        => 'number'
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['available' => 'Available', 'occupied' => 'Occupied','maintenance' => 'Maintenance'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['single' => 'Single', 'double' => 'Double','suite' => 'Suite'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([
            'label' => 'Created',
            'name' => 'created_at',
            'type' => 'date',
            'format' => 'D MMM YYYY, HH:mm'
        ]);
        CRUD::column([
            'label' => 'Updated',
            'name' => 'updated_at',
            'type' => 'date',
            'format' => 'D MMM YYYY, HH:mm'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RoomRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([
            'name'        => 'price_per_night',
            'label'       => 'Price Per Night',
            'type'        => 'number'
        ]);

        CRUD::field([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['available' => 'Available', 'occupied' => 'Occupied','maintenance' => 'Maintenance'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::field([   // select_from_array
            'name'        => 'type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['single' => 'Single', 'double' => 'Double','suite' => 'Suite'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
