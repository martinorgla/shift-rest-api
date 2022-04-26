<?php

namespace App\Services;

use App\Models\Department;
use App\Repository\DepartmentRepository;
use Illuminate\Support\Collection;

/**
 * Class DepartmentService
 * @package App\Services
 */
class DepartmentService
{
    /**
     * @var DepartmentRepository
     */
    private DepartmentRepository $departmentRepository;

    /**
     * DepartmentService constructor.
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param array|null $departments
     * @return Collection
     */
    public function bulkAdd(?array $departments): Collection
    {
        $departmentsCollection = new Collection();

        if (is_array($departments)) {
            foreach ($departments as $department) {
                $existingDepartment = $this->departmentRepository->getByName($department);

                if ($existingDepartment) {
                    $departmentsCollection->add($existingDepartment);
                }

                if (!$existingDepartment) {
                    $newDepartment = new Department();
                    $newDepartment->name = $department;
                    $departmentsCollection->add($this->departmentRepository->create($newDepartment));
                }
            }
        }

        return $departmentsCollection;
    }
}
