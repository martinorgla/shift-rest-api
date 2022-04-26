<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $shift_id
 * @property int $department_id
 */
class ShiftDepartment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shift_department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shift_id',
        'department_id',
    ];
}
