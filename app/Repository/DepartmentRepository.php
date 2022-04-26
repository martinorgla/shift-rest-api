<?php

namespace App\Repository;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DepartmentRepository
 * @package App\Repository
 */
class DepartmentRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Department::get();
    }

    /**
     * @param Department $department
     * @return bool
     */
    public function save(Department $department): bool
    {
        return $department->save();
    }

    /**
     * @param $name
     * @return Department|null
     */
    public function getByName($name): ?Department
    {
        return Department::where('name', $name)->first();
    }

    /**
     * @param Department $department
     * @return Department
     */
    public function create(Department $department): Department
    {
        return Department::create($department->toArray());
    }
}
