<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaymentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PaymentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaymentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Payment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payment');
        CRUD::setEntityNameStrings('payment', 'payments');
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
            'name'  => 'payment_date',
            'label' => 'Payment Date',
            'type' => 'date'
        ]);

        CRUD::column([  // Select
            'label'     => "Reservation",
            'type'      => 'select',
            'name'      => 'reservation_id', // the db column for the foreign key
            'entity'    => 'Reservation',
            'model'     => "App\Models\Reservation", // related model
            'attribute' => 'check_in_date', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::column([
            'name'  => 'amount',
            'label' => 'Amount',
            'type' => 'number'
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'method',
            'label'       => 'Method',
            'type'        => 'select_from_array',
            'options'     => ['cash' => 'Cash', 'online' => 'Online'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Method',
            'type'        => 'select_from_array',
            'options'     => ['pending' => 'Pending', 'completed' => 'Completed','failed' => 'Failed'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'name'  => 'payment_date',
            'label' => 'Payment Date',
            'type' => 'date'
        ]);

        CRUD::column([  // Select
            'label'     => "Reservation",
            'type'      => 'select',
            'name'      => 'reservation_id', // the db column for the foreign key
            'entity'    => 'Reservation',
            'model'     => "App\Models\Reservation", // related model
            'attribute' => 'check_in_date', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::column([
            'name'  => 'amount',
            'label' => 'Amount',
            'type' => 'number'
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'method',
            'label'       => 'Method',
            'type'        => 'select_from_array',
            'options'     => ['cash' => 'Cash', 'online' => 'Online'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Method',
            'type'        => 'select_from_array',
            'options'     => ['pending' => 'Pending', 'completed' => 'Completed','failed' => 'Failed'],
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
        CRUD::setValidation(PaymentRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([  // Select
            'label'     => "Reservation",
            'type'      => 'select',
            'name'      => 'reservation_id', // the db column for the foreign key
            'entity'    => 'Reservation',
            'model'     => "App\Models\Reservation", // related model
            'attribute' => 'check_in_date', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::field([
            'name'  => 'amount',
            'label' => 'Amount',
            'type' => 'number'
        ]);

        CRUD::field([   // select_from_array
            'name'        => 'method',
            'label'       => 'Method',
            'type'        => 'select_from_array',
            'options'     => ['cash' => 'Cash', 'online' => 'Online'],
            'allows_null' => false,
            'default'     => 'one',
        ]);

        CRUD::field([   // select_from_array
            'name'        => 'status',
            'label'       => 'Method',
            'type'        => 'select_from_array',
            'options'     => ['pending' => 'Pending', 'completed' => 'Completed','failed' => 'Failed'],
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
