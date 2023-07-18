<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyType extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'penalty_type_name',
        'penalty_type_point',
        'penalty_type_description',
    ];

    public function setPenaltyTypeNameAttribute($value)
    {
        $this->attributes['penalty_type_name'] = ucwords($value);
    }

}