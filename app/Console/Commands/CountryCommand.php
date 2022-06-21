<?php

namespace App\Console\Commands;

use App\Http\Services\CountryService;
use Illuminate\Console\Command;

class CountryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country:save-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Country command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle(CountryService $countryService)
    {
        try {
            $countryService->save();
            $this->info("Countries saved successfully.");
        } catch(\Throwable $e) {
            $this->info("Countries saved failed: " . $e->getMessage());
        }
    }
}
