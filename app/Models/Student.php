<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'student_fullname',
        'classroom_id',
    ];
    public function setStudentFullnameAttribute($value)
    {
        $this->attributes['student_fullname'] = ucwords($value);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }

    public function getAllPenalty()
    {
        return $this->hasMany(StudentPenalty::class, 'student_id','id')->withSum('PenaltyType', 'penalty_type_point');
    }

    public function getTotalPenalty(){
        return self::withSum('penalties', 'penalty_type_point');
    }

}
