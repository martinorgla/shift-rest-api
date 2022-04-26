<?php

namespace App\Repository;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class ShiftRepository
 * @package App\Repository
 */
class ShiftRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Shift::get();
    }

    /**
     * @param Shift $shift
     * @return Shift|null
     */
    public function create(Shift $shift): ?Shift
    {
        return Shift::create($shift->toArray());
    }

    /**
     * @param Shift $shift
     * @return bool
     */
    public function save(Shift $shift)
    {
        return $shift->save();
    }

    /**
     * @param string $location
     * @param string $start
     * @param string $end
     * @return Collection
     */
    public function search(string $location, string $start, string $end): Collection
    {
        return Shift::select(
            'shift.id',
            'shift.type',
            'shift.start',
            'shift.end',
            'user.user_name',
            'user.user_email',
            'shift.location',
            'shift.rate',
            'shift.charge',
            'shift.area',
            'shift.event_id',
            )
            ->join('user', 'user.id', 'shift.user_id')
            ->where('location', $location)
            ->where('start', '>=', date('Y-m-d H:i:s', strtotime($start)))
            ->where('end', '<=', date('Y-m-d H:i:s', strtotime($end)))
            ->with(
                'departments:name,start,end',
                'event:id,name,start,end'
            )
            ->get();
    }

    /**
     * This location is not correct as it's supposed to deal only with table "shift".
     * For the simplicity I'll leave it here.
     *
     * @return bool
     */
    public function deleteAll(): bool
    {
        $tableNames = ['shift', 'department', 'shift_department', 'event', 'user'];

        foreach ($tableNames as $name) {
            DB::table($name)->truncate();
        }

        return true;
    }
}
