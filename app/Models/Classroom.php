<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['classroom_name'];

    public function setClassroomNameAttribute($value)
    {
        $this->attributes['classroom_name'] = ucwords($value);
    }
}
