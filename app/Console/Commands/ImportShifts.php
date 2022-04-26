<?php

namespace App\Console\Commands;

use App\Services\ImportShiftService;
use Illuminate\Console\Command;

/**
 * Class ImportShifts
 * @package App\Console\Commands
 */
class ImportShifts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-shifts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import shifts from file';

    private ImportShiftService $importShiftService;

    /**
     * Create a new command instance.
     * @param ImportShiftService $importShiftService
     */
    public function __construct(ImportShiftService $importShiftService)
    {
        parent::__construct();
        $this->importShiftService = $importShiftService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $this->info(
            '[' . date('Y-m-d H:i:s') . '] Import shifts from file'
        );

        $file = file_get_contents('php://stdin');
        $data = json_decode($file, true);

        if (isset($data['shifts'])) {
            $this->importShiftService->importBatch($data['shifts']);
        }

        $this->info('[' . date('Y-m-d H:i:s') . '] Done!');

        return 0;
    }
}
