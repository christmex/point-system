<?php

namespace App\Http\Livewire\Analytics;

use Carbon\Carbon;
use App\Models\Student;
use Livewire\Component;
use App\Models\StudentPenalty;

class Index extends Component
{

    public $currentMonthName;
    public $getTodaysTotalPenalty = 0;
    public $getWeeksTotalPenalty = 0;
    public $getMonthsTotalPenalty = 0;
    public $getTop10PenaltyTypes;
    public $studentsPenalties;
    public $getTotalStudent = 0;

    public function mount(){
        // Init carbo
        $carbonNow = Carbon::now();

        // Set this month name
        $this->currentMonthName = Carbon::now()->format('F');
        
        // get today's date
        $currentDate = Carbon::today()->format('Y-m-d');

        // Get the start and end date of the current week
        $currentWeekStart = Carbon::now()->startOfWeek()->format('Y-m-d');
        $currentWeekEnd = Carbon::now()->endOfWeek()->format('Y-m-d');

        // get today's month
        $currentMonth = Carbon::now()->month;

        // get month start until end
        $currentMonthStart = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentMonthEnd = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Calculate the date 7 days ago
        $sevenDaysAgo = Carbon::now()->subDays(7)->format('Y-m-d');
        
        // do the query 
        $getStudentPenalty = StudentPenalty::whereMonth('student_penalty_date', $currentMonth)->get();

        // set the today's total penalty
        $this->getTodaysTotalPenalty = $getStudentPenalty->where('student_penalty_date', $currentDate)->count();
        $this->getWeeksTotalPenalty = StudentPenalty::whereBetween('student_penalty_date', [$currentWeekStart, $currentWeekEnd])->get()->count();
        $this->getMonthsTotalPenalty = $getStudentPenalty->count();

        // get total student
        $this->getTotalStudent = Student::all()->count();

        // Query ini tetap menghitung total pelanggaran yang dilakukan siswa, jadi jika siswa melakukan pelanggaran terlambat 2 kali, maka akan dihitung
        // $getTop10PenaltyTypes = StudentPenalty::join('penalty_types', 'student_penalties.penalty_type_id', '=', 'penalty_types.id')
        // ->selectRaw('penalty_types.penalty_type_name, COUNT(*) as total')
        // ->whereDate('student_penalty_date', '>=', $sevenDaysAgo)
        // ->groupBy('penalty_types.penalty_type_name')
        // ->orderByDesc('total')
        // ->take(10)
        // ->get();
        
        // Query ini digunakan untuk menghitung total pelanggaran yang ada dari tiap siswa, jadi jika siswa melakukan pelanggaran yang sama lebih dari 1 kali, maka akan dihitung 1 kali saja
        $this->getTop10PenaltyTypes = StudentPenalty::join('penalty_types', 'student_penalties.penalty_type_id', '=', 'penalty_types.id')
        ->selectRaw('penalty_types.penalty_type_name, COUNT(DISTINCT student_id) as total_students')
        ->whereDate('student_penalty_date', '>=', $sevenDaysAgo)
        ->groupBy('penalty_types.penalty_type_name')
        ->orderByDesc('total_students')
        ->take(10)
        ->get();

        // $this->studentsPenalties = Student::join('student_penalties', 'students.id', '=', 'student_penalties.student_id')
        // ->join('penalty_types', 'student_penalties.penalty_type_id', '=', 'penalty_types.id')
        // ->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
        // ->selectRaw('students.student_fullname, classrooms.classroom_name,
        //             SUM(CASE WHEN student_penalty_date = ? THEN 1 ELSE 0 END) as penalties_today,
        //             SUM(CASE WHEN student_penalty_date BETWEEN ? AND ? THEN 1 ELSE 0 END) as penalties_this_week,
        //             SUM(CASE WHEN student_penalty_date BETWEEN ? AND ? THEN 1 ELSE 0 END) as penalties_this_month,
        //             SUM(penalty_type_point) as total_penalties_points', 
        //             [$currentDate, $currentWeekStart, $currentWeekEnd, $currentMonthStart, $currentMonthEnd])
        // ->groupBy('students.id', 'students.student_fullname', 'classrooms.classroom_name')
        // ->get();

        $this->studentsPenalties = Student::leftJoin('student_penalties', 'students.id', '=', 'student_penalties.student_id')
        ->leftJoin('penalty_types', 'student_penalties.penalty_type_id', '=', 'penalty_types.id')
        ->leftJoin('classrooms', 'students.classroom_id', '=', 'classrooms.id')
        ->selectRaw('students.student_fullname, classrooms.classroom_name,
                    SUM(CASE WHEN student_penalty_date = ? THEN 1 ELSE 0 END) as penalties_today,
                    SUM(CASE WHEN student_penalty_date BETWEEN ? AND ? THEN 1 ELSE 0 END) as penalties_this_week,
                    SUM(CASE WHEN student_penalty_date BETWEEN ? AND ? THEN 1 ELSE 0 END) as penalties_this_month,
                    COUNT(student_penalties.id) as penalties_all_time,
                    SUM(penalty_type_point) as total_penalties_points', 
                    [$currentDate, $currentWeekStart, $currentWeekEnd, $currentMonthStart, $currentMonthEnd])
        ->groupBy('students.id', 'students.student_fullname', 'classrooms.classroom_name')
        ->take(5)
        ->orderBy('total_penalties_points','desc')
        ->get();
        // dd($this->studentsPenalties);
    }

    public function render()
    {
        return view('livewire.analytics.index');
    }

    
}
