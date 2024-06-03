<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {

        // Lấy tháng và năm hiện tại
        $year = date('Y');
        $today = date('y-m-d');

        if ($request->input('month') == null) {
            $currentDate = Carbon::now();
            $month = $currentDate->format('m');
        } else {
            $month = $request->input('month');
        }

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

        //Total appointment
        // Lấy ngày đầu tiên của tháng hiện tại
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        // Lấy ngày cuối cùng của tháng hiện tại
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        // Đếm số bản ghi có ngày nằm trong khoảng từ $firstDayOfMonth đến $lastDayOfMonth
        $total_appointment = Appointment::whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])->count();


        //Profit
        $total_profit = Appointment::where('payment_status', 1)
                ->whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])
                ->count() * 150000;
        $formattedPrice = number_format($total_profit, 0, ',', '.');


        //Total users
        $total_user = Customer::count();

        //total doctor
        $total_doctor = Doctor::count();


        // Tạo mảng labels và data để truyền vào view
        $labels = $dates;
        $data = [];
        foreach ($dates as $date) {
            $data[] = isset($appointments[$date]) ? $appointments[$date]->count : 0;
        }

        // so sanh doanh thu
        // Lấy dữ liệu từ database
        $dataCompare = DB::table('appointments')
            ->select(DB::raw("DATE_FORMAT(date, '%Y-%m') as month"), DB::raw('COUNT(*) as appointment_count'))
            ->whereYear('date', date('Y'))
            ->whereMonth('date', '>=', 1)
            ->whereMonth('date', '<=', 5)
            ->groupBy(DB::raw("DATE_FORMAT(date, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(date, '%Y-%m')"))
            ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        // Lấy 5 tháng gần nhất
        $months = collect();
        for ($i = 4; $i >= 0; $i--) {
            $months->push(now()->subMonths($i)->format('Y-m'));
        }

        // Chuẩn bị dữ liệu cho biểu đồ
        $labelsCompare = $months;
        $appointmentCounts = $months->map(function ($month) use ($dataCompare) {
            $record = $dataCompare->firstWhere('month', $month);
            return $record ? $record->appointment_count : 0;
        });

//        Profit of week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $revenueData = DB::table('appointments')
            ->select(DB::raw('DATE(date) as dateOfWeek'), DB::raw('COUNT(*) * 150000 as revenue'))
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('DATE(date)'))
            ->get();

        $labelsWeek = $revenueData->map(function ($item) {
            return Carbon::parse($item->dateOfWeek)->format('l'); // 'l' formats the date to the full day name
        });
        $dataWeek = $revenueData->pluck('revenue');

        return view('admin.statistic.index', [
            'labels' => $labels,
            'data' => $data,
            'appointments_today' => $appointments_today,
            'total_appointment' => $total_appointment,
            'total_profit' => $formattedPrice,
            'total_doctor' => $total_doctor,
            'total_user' => $total_user,
        ], compact('labelsCompare', 'appointmentCounts', 'labelsWeek', 'dataWeek'));
    }

    public function getData(Request $request){

        $month = $request->input('month');
        if(!$month) {
            $currentDate = Carbon::now();
            $month = $currentDate->format('Y-m');
        }

        $startOfMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endOfMonth = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $appointmentsData = DB::table('appointments')
            ->select(DB::raw('DATE(date) as date'), DB::raw('COUNT(*) as appointments'))
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->groupBy(DB::raw('DATE(date)'))
            ->get();

        $labels = $appointmentsData->pluck('date');
        $data = $appointmentsData->pluck('appointments');

        return response()->json(['labels' => $labels, 'data' => $data]);
    }

}
