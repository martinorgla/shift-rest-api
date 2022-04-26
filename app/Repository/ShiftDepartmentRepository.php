<?php

namespace App\Repository;

use App\Models\ShiftDepartment;

/**
 * Class ShiftDepartmentRepository
 * @package App\Repository
 */
class ShiftDepartmentRepository
{
    /**
     * @param ShiftDepartment $shiftDepartment
     * @return bool
     */
    public function save(ShiftDepartment $shiftDepartment): bool
    {
        return $shiftDepartment->save();
    }
}
