<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $type
 * @property string $start
 * @property string $end
 * @property int $user_id
 * @property string $location
 * @property int $event_id
 * @property int $rate
 * @property int $charge
 * @property string $area
 * @method static create(array $toArray)
 * @method static get()
 */
class Shift extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shift';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'start',
        'end',
        'location',
        'event_id',
        'rate',
        'charge',
        'area',
        'user_id',
        'departments',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Shift $shift) {
            $shift->shiftDepartment()->delete();
        });
    }

    /**
     * @return HasMany
     */
    public function shiftDepartment(): HasMany
    {
        return $this->hasMany(ShiftDepartment::class, 'shift_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasManyThrough
     */
    public function departments(): HasManyThrough
    {
        return $this->hasManyThrough(
            Event::class,
            ShiftDepartment::class,
            'shift_id',
            'id',
            'id',
            'department_id'
        );
    }

    /**
     * @return HasOne
     */
    public function event(): HasOne
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }
}
