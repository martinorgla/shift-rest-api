<?php

namespace App\Services;

/**
 * Class ImportShiftService
 * @package App\Services
 */
class ImportShiftService
{
    /**
     * @var ShiftService
     */
    public ShiftService $shiftService;

    /**
     * ImportShiftService constructor.
     * @param ShiftService $shiftService
     */
    public function __construct(ShiftService $shiftService)
    {
        $this->shiftService = $shiftService;
    }

    /**
     * @param array $shifts
     * @return bool
     */
    public function importBatch(array $shifts): bool
    {
        try {
            foreach ($shifts as $shift) {
                if ($this->validate($shift)) {
                    $this->shiftService->create($shift);
                }
            }
        } catch (\Exception $e) {
            // Log
            return false;
        }

        return true;
    }

    /**
     * @param $shift
     * @return bool
     */
    private function validate($shift): bool
    {
        $shift = (array)$shift;
        $requiredKeys = ['type', 'user_email', 'location', 'start', 'end'];

        foreach ($requiredKeys as $key) {
            if (!isset($shift[$key]) || !strlen($shift[$key])) {
                return false;
            }
        }

        return true;
    }
}
