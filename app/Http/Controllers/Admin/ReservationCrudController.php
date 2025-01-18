<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReservationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;
/**
 * Class ReservationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReservationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Reservation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/reservation');
        CRUD::setEntityNameStrings('reservation', 'reservations');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addButtonFromModelFunction('top', 'export_button', 'export', 'end');
        CRUD::column([
            'name' => 'check_in_date',
            'label' => 'Check In Date',
            'type' => 'date'
        ]);

        CRUD::column([
            'name' => 'check_out_date',
            'label' => 'Check Out Date',
            'type' => 'date'
        ]);

        CRUD::column([
            'name' => 'total_price',
            'label' => 'Total Price',
            'type' => 'number'
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['reserved' => 'Reserved', 'checked_in' => 'Checked In','checked_out' => 'Checked Out','cancelled' => 'Cancelled'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([  // Select
            'label'     => "Guest",
            'type'      => 'select',
            'name'      => 'guest_id', // the db column for the foreign key
            'entity'    => 'Guest',
            'model'     => "App\Models\Guest", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::column([  // Select
            'label'     => "Room",
            'type'      => 'select',
            'name'      => 'room_id', // the db column for the foreign key
            'entity'    => 'Room',
            'model'     => "App\Models\Room", // related model
            'attribute' => 'room_number', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'name' => 'check_in_date',
            'label' => 'Check In Date',
            'type' => 'date'
        ]);

        CRUD::column([
            'name' => 'check_out_date',
            'label' => 'Check Out Date',
            'type' => 'date'
        ]);

        CRUD::column([
            'name' => 'total_price',
            'label' => 'Total Price',
            'type' => 'number'
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['reserved' => 'Reserved', 'checked_in' => 'Checked In','checked_out' => 'Checked Out','cancelled' => 'Cancelled'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([  // Select
            'label'     => "Guest",
            'type'      => 'select',
            'name'      => 'guest_id', // the db column for the foreign key
            'entity'    => 'Guest',
            'model'     => "App\Models\Guest", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::column([  // Select
            'label'     => "Room",
            'type'      => 'select',
            'name'      => 'room_id', // the db column for the foreign key
            'entity'    => 'Room',
            'model'     => "App\Models\Room", // related model
            'attribute' => 'room_number', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
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
        CRUD::setValidation(ReservationRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([
            'name' => 'total_price',
            'label' => 'Total Price',
            'type' => 'number'
        ]);

        CRUD::field([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['reserved' => 'Reserved', 'checked_in' => 'Checked In','checked_out' => 'Checked Out','cancelled' => 'Cancelled'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::field([  // Select
            'label'     => "Guest",
            'type'      => 'select',
            'name'      => 'guest_id', // the db column for the foreign key
            'entity'    => 'Guest',
            'model'     => "App\Models\Guest", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::field([  // Select
            'label'     => "Room",
            'type'      => 'select',
            'name'      => 'room_id', // the db column for the foreign key
            'entity'    => 'Room',
            'model'     => "App\Models\Room", // related model
            'attribute' => 'room_number', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
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

    public function export()
    {
        $reservations = \App\Models\Reservation::orderBy('id','desc')->get();   
        $pdf = Pdf::loadView('export.reservation',['reservations' => $reservations]);
        return $pdf->stream();
    }
}
