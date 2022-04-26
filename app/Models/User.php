<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_name
 * @property int $user_email
 * @method static get()
 * @method static where(string $string, int $configurationId)
 * @method static updateOrCreate(array $array, array $array1)
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'user_email',
    ];
}
