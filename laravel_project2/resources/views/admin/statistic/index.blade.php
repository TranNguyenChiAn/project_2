@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
{{--@include('admin.layout.menu')--}}

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('frontend/js/appointments-chart.js') }}"></script>
    <style>
        #chart-container {
            width:100%;
            max-width: 720px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background-color: white;
        }

    </style>
    <title> Homepage </title>
</head>
<body>
@php
//mo ket noi
    $tm = strtotime("today");
    $this_month =  date("Y-m", $tm);
    //Khai báo biến search
    $month = "";
@endphp

<section style="margin: 18px 0 0 280px">
    <div class="d-flex">
        {{--        Statistic--}}
        <div id="chart-container">
            <form method="post" action="{{route('statistic.getAppointmentsData')}}" class="d-flex">
                @csrf
                @method('post')
{{--                <input type="month" class="form-control w-50" name="month" value="{{$this_month}}"--}}
{{--                       max="{{ $this_month}}">--}}
{{--                <button class="btn btn-primary mx-2" type="submit"> Submit </button>--}}
                <p style="font-size: 14px"><b>This month</b></p>
            </form>
            <div class="content">
                {{--      TOTAL         --}}
                <div class="d-flex w-100">
                    {{--            Amount--}}
                    <div class="d-flex row g-4 justify-content-between mb-4 flex-wrap" style="width: 123%">
                        {{--                total appointment--}}
                        <div class="col-6">
                            {{--                total appointment--}}
                            <div class="flex-row card px-4 py-2 align-items-center" >
                                <i class="bi bi-journal fs-5 rounded-2 p-3" style="background-color: #2f2ffe; color: white"></i>
                                <div class="mx-3">
                                    <p class="m-0"><b> {{ $total_appointment}}</b></p>
                                    <p>Total Appointment</p>
                                </div>
                                <a href="{{route('appointment.index')}}">
                                    <i class="bi bi-arrow-right-circle fs-5"></i>
                                </a>
                            </div>
                        </div>

                        {{--                total profit--}}
                        <div class="col-6">
                            <div class="flex-row card px-4 py-2 align-items-center">
                                <i class="bi bi-cash fs-5 rounded-2 p-3" style="background-color: #2f2ffe; color: white"></i>
                                <div class="mx-3">
                                    <p class="m-0"><b>{{ $total_profit }}VND</b></p>
                                    <p>Total Profit</p>
                                </div>
                            </div>
                        </div>

                        {{--                total doctor--}}
                        <div class="col-6">
                            <div class="flex-row card px-4 py-2 align-items-center">
                                <i class="bi bi-person fs-5 rounded-2 p-3" style="background-color: #2f2ffe; color: white"></i>
                                <div class="mx-3">
                                    <p class="m-0"><b>{{ $total_doctor }}</b></p>
                                    <p>Total Doctor</p>
                                </div>
                                <a href="{{route('admin.doctor')}}">
                                    <i class="bi bi-arrow-right-circle fs-5"></i>
                                </a>
                            </div>
                        </div>

                        {{--                total users--}}
                        <div class="col-6">
                            <div class="flex-row card px-4 py-2 align-items-center">
                                <i class="bi bi-person-vcard-fill fs-5 rounded-2 p-3" style="background-color: #2f2ffe; color: white"></i>
                                <div class="mx-3">
                                    <p class="m-0"><b>{{ $total_user }}</b></p>
                                    <p>Total Users</p>
                                </div>
                                <a href="{{route('customer.index')}}">
                                    <i class="bi bi-arrow-right-circle fs-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  Statistic card    --}}
                <div class="card" style="">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4><b>Statistics this month</b></h4>
                        </div>
                        <canvas id="appointmentChart"></canvas>
                    </div>
                </div>
                <br>
                <div class="card" style="">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4><b>Compare 5 month</b></h4>
                        </div>
                        <canvas id="compareChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{--            Today--}}
        <div class="">
            <div class="card m-4 mt-0 ">
                <div class="card-body">
                    <h4> Profit this day</h4>
                        <canvas id="compareProfit"></canvas>
                </div>
            </div>
            <div class="card m-4 mt-0 ">
                <div class="card-body">
                    <h4> Today's customers</h4>
                    <div class="d-block">
                        @foreach($appointments_today as $appointment_today)
                            <a class="text-dark text-decoration-none link-opacity-10-hover" href="{{route('appointment.edit', $appointment_today)}}">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person bg-primary rounded-circle p-lg-2 fs-3" style="color: white"></i>
                                    <div class="mx-3 mt-2">
                                        <p class=" m-0"><b>{{$appointment_today -> customer_name}}</b></p>
                                        <p style="color: darkgrey; font-size: 11px">{{$appointment_today -> time}} - Doctor {{$appointment_today -> doctor->name}}</p>
                                    </div>
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
<br>
{{-- Statistic this month --}}
<script>
    let ctx = document.getElementById('appointmentChart').getContext('2d');
    let appointmentChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Amount of appointments',
                data: @json($data),
                backgroundColor: 'rgba(10,62,229,0.76)',
                borderColor: 'rgb(21,64,234)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

{{-- Compare monthh profit --}}
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let ctx = document.getElementById('compareChart').getContext('2d');
        let compareChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labelsCompare),
                datasets: [{
                    label: 'Amount of appointments',
                    data: @json($appointmentCounts),
                    backgroundColor: 'rgba(10,62,229,0.76)',
                    borderColor: 'rgb(21,64,234)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

{{-- Compare week profit --}}
<script>
    document.addEventListener('DOMContentLoaded', (event) =>  {
        let ctx = document.getElementById('compareProfit').getContext('2d');
        let revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labelsWeek),
                datasets: [{
                    label: 'Revenue',
                    data: @json($dataWeek),
                    backgroundColor: 'rgb(34,180,225)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
</body>
</html>

