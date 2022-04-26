<?php

namespace App\Services;

use App\Repository\ShiftRepository;

/**
 * Class DeleteService
 * @package App\Services
 */
class DeleteService
{
    /**
     * @var ShiftRepository
     */
    private ShiftRepository $shiftRepository;

    /**
     * DeleteService constructor.
     * @param ShiftRepository $shiftRepository
     */
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }
}
