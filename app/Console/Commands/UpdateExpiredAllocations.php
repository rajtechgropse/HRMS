<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\addworkesEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateExpiredAllocations extends Command
{
    protected $signature = 'allocations:update-expired';
    protected $description = 'Update allocations that have expired';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now()->toDateString();
      
        $records = addworkesEmployee::where('enddate', '<', $today)
            ->where('is_deleted', 0)->update([
                'is_deleted' => 1,

            ]);
           
    }
}
