@vite(["resources/sass/app.scss", "resources/js/app.js"])

<style>
    .nav-link .active {
        font-weight: bold; /* hoặc bất kỳ kiểu định dạng nào bạn muốn */
        color: #2f2ffe; /* màu sắc của liên kết active */
    }
</style>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{asset('./images/logo_fraud.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
</head>

<div class="d-flex flex-column position-fixed"
     style="width: 260px;height: 100vh; background-color: white">
    <div class="d-flex mt-lg-4 mx-3">
        <i class="bi bi-emoji-laughing-fill fs-1 mx-3"></i>
        <div>
            <p class="p-0 m-0">
                <b>{{session('admin.name')}}</b>
            </p>
            <p style="color: #b7b6b6; font-size: 12px"> Dashboard</p>

        </div>
    </div>
    <ul class="nav d-flex flex-column mt-4 align-content-center"
        style="font-weight: bold; font-size: 16px">
        <li>
            <a href="{{ route('statistic.index')}}" id="dashboard_link" class="nav-link link-secondary">
                <i class="bi bi-pie-chart-fill"></i>
                Statistic
            </a>
        </li>
        <li>
            <a href="{{ route('appointment.showData') }}" id="schedule_link"  class="nav-link link-secondary">
                <i class="bi bi-calendar-fill"></i>
                Schedule
            </a>
        </li>
        <li>
            <a href="{{ route('admin.doctor') }}" id="doctor_link"  class="nav-link link-secondary">
                <i class="bi bi-person-fill"></i>
                Doctors
            </a>
        </li>
        <li>
            <a href="{{ route('department.index') }}" id="specialization_link" class="nav-link link-secondary">
                <i class="bi bi-list"></i>
                Department
            </a>
        </li>
        <li>
            <a href="{{ route('appointment.index') }}" id="appointment_link"  class="nav-link link-secondary">
                <i class="bi bi-journal"></i>
                Appointments
            </a>
        </li>
        <li>
            <a href="{{ route('customer.index')}}" id="customer_link"  class="nav-link link-secondary">
                <i class="bi bi-person-vcard-fill"></i>
                Customers
            </a>
        </li>
        <li>
            <a href="{{ route('shift.index')}}" id="shift_link"  class="nav-link link-secondary">
                <i class="bi bi-clock-fill"></i>
                Shifts
            </a>
        </li>
        <li>
            <a href="{{ route('room.index')}}" id="room_link"  class="nav-link link-secondary">
                <i class="bi bi-house"></i>
                Rooms
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" class="nav-link link-secondary">
                <i class="bi bi-power"></i>
                Logout
            </a>
        </li>
    </ul>
</div>
<script defer src="{{ asset('frontend/js/activePage.js')}}"></script>

