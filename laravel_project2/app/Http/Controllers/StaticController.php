<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    public function index(){

        // Lấy tháng và năm hiện tại
        $year = date('Y');
        $month = date('m');
        $today = date('y-m-d');

        // Tạo danh sách các ngày trong tháng hiện tại
        $daysInMonth = Carbon::parse("$year-$month-01")->daysInMonth;
        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = $day;
        }

        // Lấy dữ liệu số lượng đơn đặt lịch khám từng ngày theo tháng hiện tại
        $appointments = DB::table('appointments')
            ->select(DB::raw('DAY(date) as day'), DB::raw('count(*) as count'))
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy(DB::raw('DAY(date)'))
            ->orderBy('day')
            ->get()
            ->keyBy('day')
            ->toArray();


        $appointments_today = Appointment::with('doctor')
        ->where('date', "=", $today)->get();

        // Tạo mảng labels và data để truyền vào view
        $labels = $dates;
        $data = [];
        foreach ($dates as $date) {
            $data[] = isset($appointments[$date]) ? $appointments[$date]->count : 0;
        }

        return view('admin.statistic.index', [
            'labels' => $labels,
            'data' => $data,
            'appointments_today' => $appointments_today
        ]);
    }

}
