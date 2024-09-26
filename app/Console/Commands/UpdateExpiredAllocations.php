<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
<<<<<<< HEAD
use App\Models\AddworkesEmployee;
=======
use App\Models\addworkesEmployee;
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
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
      
<<<<<<< HEAD
        $records = AddworkesEmployee::where('enddate', '<', $today)
=======
        $records = addworkesEmployee::where('enddate', '<', $today)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            ->where('is_deleted', 0)->update([
                'is_deleted' => 1,

            ]);
           
    }
}
