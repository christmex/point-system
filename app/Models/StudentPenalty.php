<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPenalty extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'penalty_type_id',
        'student_penalty_description',
        'student_penalty_date',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function PenaltyType()
    {
        return $this->belongsTo(PenaltyType::class, 'penalty_type_id');
    }
}
