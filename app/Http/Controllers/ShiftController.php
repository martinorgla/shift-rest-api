<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShiftsRequest;
use App\Http\Requests\SearchShiftsRequest;
use App\Services\ImportShiftService;
use App\Services\ShiftService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class ShiftController
 * @package App\Http\Controllers
 */
class ShiftController extends Controller
{
    /**
     * @var ImportShiftService
     */
    private ImportShiftService $importShiftService;

    /**
     * @var ShiftService
     */
    private ShiftService $shiftService;

    /**
     * ShiftController constructor.
     * @param ShiftService $shiftService
     * @param ImportShiftService $importShiftService
     */
    public function __construct(ShiftService $shiftService, ImportShiftService $importShiftService)
    {
        $this->importShiftService = $importShiftService;
        $this->shiftService = $shiftService;
    }

    /**
     * @param CreateShiftsRequest $request
     * @return JsonResponse
     */
    public function bulkCreate(CreateShiftsRequest $request): JsonResponse
    {
        $body = [
            'success' => $this->importShiftService->importBatch($request->shifts),
        ];

        return Response::json($body, $body['success'] ? 201 : 400);
    }

    /**
     * @param SearchShiftsRequest $request
     * @return JsonResponse
     */
    public function search(SearchShiftsRequest $request): JsonResponse
    {
        $shifts = $this->shiftService->search($request->location, $request->start, $request->end);

        return Response::json(
            ['shifts' => $shifts],
            200
        );
    }

    /**
     *
     * @return JsonResponse
     */
    public function deleteAllData(): JsonResponse
    {
        try {
            $body = [
                'success' => $this->shiftService->deleteAllShifts(),
            ];

            return Response::json($body, 200);
        } catch (\Exception $e) {
            // Log
            return Response::json(
                [
                    'success' => false,
                ],
                400
            );
        }
    }
}
