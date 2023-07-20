<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \App\Http\Controllers\Admin\Operations\AssignStudentPenaltyOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('Murid', 'Daftar Murid');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::disableResponsiveTable();
        CRUD::removeButtons(['update','show']);
        if(backpack_user()->email != 'super@admin.com'){
            CRUD::removeButtons(['create']);
        }
        CRUD::column('student_fullname')->label('Nama Murid')->limit(1000);
        CRUD::addColumn([
            'type' => 'select',
            'label' => 'Kelas',
            'name' => 'classroom_id',
            'entity' => 'classroom',
            'attribute' => 'classroom_name',
            'limit' => 1000,
        ]);
        CRUD::addColumn([
            "label" => "Point Pelanggaran",
            "type" => "select",
            "entity" => "getAllPenalty.PenaltyType",
            "model" => "App\Models\StudentPenalty",
            "limit" => 1000,
            "attribute" => "penalty_type_point",
        ]);
        CRUD::addColumn([
            "label" => "Nama Pelanggaran",
            "type" => "select",
            "entity" => "getAllPenalty.PenaltyType",
            "model" => "App\Models\StudentPenalty",
            "limit" => 1000,
            "attribute" => "penalty_type_name",
        ]);

        CRUD::addColumn([
            'name'  => 'total_pinalties',
            "label" => "Sisa Point",
            "type" => "model_function",
            "function_name" => "getTotalPenalty",
            "limit" => 1000,
            "escaped" => false,
            'attribute' => 'penalty_type_sum_penalty_type_point',
            "value" => function($query){
                $sum = $query->getAllPenalty->sum('penalty_type_sum_penalty_type_point');
                // dd($query->getAllPenalty);
                $defaultPoint = 1000;
                if($sum){
                    $do_sum = 1000 - $sum;
                    if($do_sum >= 500){
                        return '<span class="badge bg-yellow">'.$defaultPoint."-".$sum."=".$do_sum."</span>";
                    }
                    return '<span class="badge bg-red">'.$defaultPoint."-".$sum."=".$do_sum."</span>";
                }
                return '<span class="badge bg-green">'.$defaultPoint."</span>";
            }
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
        CRUD::setValidation(StudentRequest::class);
        CRUD::field('student_fullname')->label('Nama Murid');
        CRUD::addField([
            'type' => 'select',
            'label' => 'Kelas',
            'name' => 'classroom_id',
            'entity' => 'classroom',
            'attribute' => 'classroom_name',
            'limit' => 1000,
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
        $studentConfig = CRUD::getCurrentEntry()->StudentConfig();
        if (!backpack_user()->can('schools.view.'.$studentConfig->school_id)) {
            CRUD::denyAccess(['update']);
            abort(403, 'Anda sudah tidak punya akses kesini lagi');
        }
        CRUD::setValidation(StudentRequest::class);
        // $this->setupCreateOperation();
        
        // $schoolId = Helper::getAccesableSchool();

        // ================unccomentthisklaumauubadh ini dan  uncomment model event di stundet.php
        // CRUD::addField([
        //     "name" => "school_year_id",
        //     "label" => "Tahun Ajaran",
        //     "allows_null" => false,
        //     "model" => "App\Models\SchoolYear",
        //     "type" => "select",
        //     "attribute" => "school_year_name",
        //     'options'   => (function ($query) use($studentConfig){
        //         return $query->where('id', $studentConfig->school_year_id)->get();
        //     }),
        //     'searchLogic' => false,
        //     'tab' => "Step 1",
        //     'hint' => 'Untuk melihat semua tahun ajaran atau mengubah tahun ajaran yang aktif silahkan <a href="'.backpack_url('school-year').'">klik disini</a>',
        // ]);
        // CRUD::addField([
        //     "name" => "semester_id",
        //     "label" => "Semester",
        //     "allows_null" => false,
        //     "model" => "App\Models\Semester",
        //     "type" => "select",
        //     "attribute" => "semester_name",
        //     'options'   => (function ($query) use($studentConfig){
        //         return $query->where('id', $studentConfig->semester_id)->get();
        //     }),
        //     'tab' => "Step 1",
        //     'hint' => 'Untuk melihat semua semester atau mengubah semester yang aktif silahkan <a href="'.backpack_url('semester').'">klik disini</a>',
        // ]);


        
        // CRUD::addField([
        //     'type' => 'select',
        //     'label' => 'Nama Sekolah',
        //     'name' => 'school_id',
        //     // 'entity' => 'StudentConfig', //comment when you save it throw errors
        //     "model" => "App\Models\School",
        //     'attribute' => 'school_name',
        //     'allows_null' => false,
        //     'pivot' => true,
        //     'options'   => (function ($query) use($schoolId) {
        //         return $query->whereIn('id', $schoolId)->get();
        //     }),
        //     'default' => $studentConfig->school_id,
        //     'tab' => "Step 2",
        // ]);
        // ================unccomentthisklaumauubadh ini dan  uncomment model event di stundet.php
        CRUD::field('student_config_id')->default($studentConfig->id)->type('hidden');
        CRUD::field('school_id')->default($studentConfig->school_id)->type('hidden');
        CRUD::field('school_name')->default($studentConfig->School()->first()->school_name)->attributes(['disabled' => 'disabled']);
        CRUD::field('student_fullname');
        CRUD::field([
            'name' => 'student_spp_va',
            'default' => $studentConfig->student_spp_va,
            // 'tab' => 'Step 2',
        ])->attributes(['pattern' => '[0-9]+', 'placeholder' => 'Ex:20221001'])->hint('number only');
        CRUD::field([
            'name' => 'student_book_va',
            'default' => $studentConfig->student_book_va,
            // 'tab' => 'Step 2',
        ])->attributes(['pattern' => '[0-9]+', 'placeholder' => 'Ex:40221001'])->hint('number only');
        // modify crud school year  and  semester
        // kayaknya lebih baik pisah validasi request
    }
}
