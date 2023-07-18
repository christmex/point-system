<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Requests\StudentPenaltyRequest;
use App\Models\StudentPenalty;
use Backpack\CRUD\app\Http\Controllers\Operations\Concerns\HasForm;

trait AssignStudentPenaltyOperation
{
    use HasForm;

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupAssignStudentPenaltyRoutes(string $segment, string $routeName, string $controller): void
    {
        $this->formRoutes(
            operationName: 'assignStudentPenalty',
            routesHaveIdSegment: true,
            segment: $segment,
            routeName: $routeName,
            controller: $controller
        );
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupAssignStudentPenaltyDefaults(): void
    {
        $this->formDefaults(
            operationName: 'assignStudentPenalty',
            buttonStack: 'line', // alternatives: top, bottom
            buttonMeta: [
                'icon' => 'la la-exclamation',
                'label' => 'Tambah Pelanggaran',
                'wrapper' => [
                    //  'target' => '_blank',
                ],
            ],
        );

        $this->crud->operation('assignStudentPenalty', function () {
            $this->crud->setValidation(StudentPenaltyRequest::class);
            $this->crud->field([
                'label'     => 'Nama Murid',
                'name'      => 'student_name',
                'default'   => $this->crud->getCurrentEntry()->student_fullname,
                'attributes'=> ['readonly' => 'readonly'],
            ]);
            $this->crud->field([
                'type'     => 'hidden',
                'name'      => 'user_id',
                'default'   => backpack_user()->id,
            ]);
            $this->crud->field([
                'type'     => 'hidden',
                'name'      => 'student_id',
                'default'   => $this->crud->getCurrentEntry()->id,
            ]);
            $this->crud->field([
                'label'     => 'Jenis Pelanggaran',
                'type'      => 'select',
                'allows_null'      => false,
                'name'      => 'penalty_type_id',
                'model'     => "App\Models\PenaltyType",
                'attribute' => 'penalty_type_name',
            ]);
            $this->crud->field('student_penalty_description')->label('Kronologi')->type('textarea');
            $this->crud->field('student_penalty_date')->label('Tanggal Kejadian')->type('date')->default(date('Y-m-d'));
        });
    }

    /**
     * Method to handle the GET request and display the View with a Backpack form
     *
     */
    public function getAssignStudentPenaltyForm(?int $id = null) : \Illuminate\Contracts\View\View
    {
        $this->crud->hasAccessOrFail('assignStudentPenalty');

        return $this->formView($id);
    }

    /**
    * Method to handle the POST request and perform the operation
    *
    * @return array|\Illuminate\Http\RedirectResponse
    */
    public function postAssignStudentPenaltyForm(?int $id = null)
    {
        $this->crud->hasAccessOrFail('assignStudentPenalty');

        return $this->formAction($id, function ($inputs, $entry) {
            // You logic goes here...
            unset($inputs['student_name']);
            // dd('got to ' . __METHOD__, $inputs, $entry);
            StudentPenalty::create($inputs);

            // show a success message
            \Alert::success('Berhasil menambahkan data pelanggaran!')->flash();
        });
    }
}
