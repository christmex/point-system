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

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            if($obj){
                StudentPenalty::where('penalty_type_id', $obj->id)->delete();
            }
        });
    }

    public function setPenaltyTypeNameAttribute($value)
    {
        $this->attributes['penalty_type_name'] = ucwords($value);
    }

}