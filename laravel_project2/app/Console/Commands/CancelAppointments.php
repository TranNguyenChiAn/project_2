<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CancelAppointments extends Command
{
    protected $signature = 'appointments:cancel';

    protected $description = 'Cancel appointments before 12 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $appointments = Appointment::where('start_time', '<', Carbon::now()->addHours(12))->get();

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        $this->info('Appointments canceled successfully.');
    }
//    /**
//     * The name and signature of the console command.
//     *
//     * @var string
//     */
//    protected $signature = 'app:cancel-appointments';
//
//    /**
//     * The console command description.
//     *
//     * @var string
//     */
//    protected $description = 'Command description';
//
//    /**
//     * Execute the console command.
//     */
//    public function handle()
//    {
//        //
//    }
}
