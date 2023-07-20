<?php

namespace App\Http\Livewire\Guest;

use App\Models\Student;
use App\Models\StudentPenalty;
use Livewire\Component;

class CheckStudentReward extends Component
{
    public $formStudentName;
    public $formStudentId;
    public $formStudentNameSearchResult;
    public $modelStudentPenalty;
    public $totalPenaltyPoint=0;
    public $disabledBtn = true;

    public function render()
    {
        return view('livewire.guest.check-student-reward');
    }

    
    public function send_alert($type,$text){
        $this->dispatchBrowserEvent('alert_dispatch', ['text' => $text,"type" => $type]);
    }

    public function updatedformStudentName(){
        $this->disabledBtn = true;
        if(!empty($this->formStudentName)){
            $this->formStudentNameSearchResult = Student::where('student_fullname','like','%'.$this->formStudentName.'%')
                ->paginate(5)->items();
            if(count($this->formStudentNameSearchResult) == 0){
                $this->formStudentName = NULL;
            }
        }else {
            $this->formStudentName = NULL;
        }
    }

    public function search(){
        if(empty($this->formStudentName)){
            $this->send_alert('warning','Silahkan isi semua field');
        }
        $this->modelStudentPenalty = StudentPenalty::with('PenaltyType')
            ->where('student_id',$this->formStudentId)
            ->withSum('PenaltyType','penalty_type_point')
            ->get();
        if(empty($this->modelStudentPenalty)){
            $this->send_alert('warning','Tidak ditemukan, silahkan cek kembali data anda');
        }else {
            $this->totalPenaltyPoint = $this->modelStudentPenalty->sum('penalty_type_sum_penalty_type_point');
            $this->send_alert('success','Berhasil Mendapatkan Data');
        }
    }

    public function setValue($id,$value){
        $this->disabledBtn = false;
        $this->formStudentId = $id;
        $this->formStudentName = $value;
        $this->formStudentNameSearchResult = null;
    }

    public function formReset(){
        $this->formStudentName = null;
        $this->totalPenaltyPoint = 0;
        $this->formStudentId = null;
        $this->modelStudentPenalty = null;
        $this->formStudentNameSearchResult = null;
    }
}
