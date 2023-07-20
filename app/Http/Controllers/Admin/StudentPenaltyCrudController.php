<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentPenaltyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentPenaltyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentPenaltyCrudController extends CrudController
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
        CRUD::setModel(\App\Models\StudentPenalty::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student-penalty');
        CRUD::setEntityNameStrings('Pelanggaran Murid', 'Daftar Pelanggaran Murid');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::disableResponsiveTable();
        CRUD::removeButtons(['create','update','show']);
        if(backpack_user()->email != 'super@admin.com'){
            CRUD::removeButtons(['create']);
        }
        CRUD::addColumn([
            "name" => "user_id",
            "label" => "Nama Guru",
            "entity" => "user",
            "type" => "select",
            "attribute" => "name",
        ]);
        CRUD::addColumn([
            "name" => "student_id",
            "label" => "Nama Murid",
            "entity" => "Student",
            "type" => "select",
            "attribute" => "student_fullname"
        ]);
        CRUD::addColumn([
            "name" => "penalty_type_id",
            "label" => "Jenis Pelanggaran",
            "entity" => "PenaltyType",
            "type" => "select",
            "attribute" => "penalty_type_name"
        ]);
        CRUD::column('student_penalty_description')->limit(1000)->label('Kronologi');
        CRUD::column('student_penalty_date')->label('Tanggal');

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentPenaltyRequest::class);

        CRUD::field('user_id');
        CRUD::field('student_id');
        CRUD::field('penalty_type_id');
        CRUD::field('student_penalty_description');
        CRUD::field('student_penalty_date');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
