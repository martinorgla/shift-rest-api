<?php

namespace App\Services;

use App\Models\Shift;
use App\Models\ShiftDepartment;
use App\Repository\ShiftDepartmentRepository;
use App\Repository\ShiftRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ShiftService
 * @package App\Services
 */
class ShiftService
{
    /**
     * @var DepartmentService
     */
    private DepartmentService $departmentService;

    /**
     * @var EventService
     */
    private EventService $eventService;

    /**
     * @var ShiftRepository
     */
    private ShiftRepository $shiftRepository;

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @var ShiftDepartmentRepository
     */
    private ShiftDepartmentRepository $shiftDepartmentRepository;

    /**
     * ShiftService constructor.
     * @param DepartmentService $departmentService
     * @param EventService $eventService
     * @param ShiftDepartmentRepository $shiftDepartmentRepository
     * @param ShiftRepository $shiftRepository
     * @param UserService $userService
     */
    public function __construct(
        DepartmentService $departmentService,
        EventService $eventService,
        ShiftDepartmentRepository $shiftDepartmentRepository,
        ShiftRepository $shiftRepository,
        UserService $userService
    ) {
        $this->departmentService = $departmentService;
        $this->eventService = $eventService;
        $this->shiftDepartmentRepository = $shiftDepartmentRepository;
        $this->shiftRepository = $shiftRepository;
        $this->userService = $userService;
    }

    /**
     * @param $shift
     */
    public function create($shift): void
    {
        $user = $this->userService->updateOrCreate(
            $shift['user_email'],
            $shift['user_name'] ?? null
        );

        if ($shift['event']) {
            $event = $this->eventService->findByName($shift['event']['name']);

            if (!$event) {
                $event = $this->eventService->create($shift['event']);
            }
        }

        $shiftModel = new Shift();
        $shiftModel->type = $shift['type'];
        $shiftModel->start = date('Y-m-d H:i:s', strtotime($shift['start']));
        $shiftModel->end = date('Y-m-d H:i:s', strtotime($shift['end']));
        $shiftModel->user_id = $user->id ?? null;
        $shiftModel->location = $shift['location'];
        $shiftModel->event_id = $event['id'] ?? null;
        $shiftModel->rate = $shift['rate'];
        $shiftModel->charge = $shift['charge'];
        $shiftModel->area = $shift['area'];
        $shiftRecord = $this->shiftRepository->create($shiftModel);

        $departments = $this->departmentService->bulkAdd($shift['departments']);

        foreach ($departments as $department) {
            $shiftDepartment = new ShiftDepartment();
            $shiftDepartment->department_id = $department->id;
            $shiftDepartment->shift_id = $shiftRecord->id;
            $this->shiftDepartmentRepository->save($shiftDepartment);
        }
    }

    /**
     * @param string $location
     * @param string $start
     * @param string $end
     * @return Collection
     */
    public function search(string $location, string $start, string $end): Collection
    {
        return $this->shiftRepository->search($location, $start, $end);
    }

    /**
     * @return bool
     */
    public function deleteAllShifts(): bool
    {
        return $this->shiftRepository->deleteAll();
    }
}
