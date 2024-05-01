<style>
    .nav-link {
        color: #cecdcd;
    }

    .nav-link:hover{
        color:white;
    }
</style>
<div class="d-flex flex-column flex-shrink-0 p-3"
     style="width: 246px;height: 100%; position: absolute; background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);">
    <a class="d-flex nav-link align-items-center text-decoration-none text-white">
        <svg class="bi me-2" width="32" height="28"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">
            <b>{{session('admin.name')}}</b>
        </span>
    </a>
    <hr style="border: 1px solid black">
    <ul class="nav nav-pills flex-column mb-auto justify-content-around text"
        style="font-family: Inter; font-weight: bold">
        <li class="nav-item">
            <a href="{{ route('appointment.showData') }}" class="nav-link">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.doctor') }}" class="nav-link">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Doctors
            </a>
        </li>
        <li>
            <a href="{{ route('specialization.index') }}" class="nav-link">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Specialization
            </a>
        </li>
        <li>
            <a href="{{ route('appointment.index') }}" class="nav-link">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Appointments
            </a>
        </li>
        <li>
            <a href="{{ route('customer.index')}}" class="nav-link">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Customers
            </a>
        </li>
        <li>
            <a href="{{ route('shift.index')}}" class="nav-link">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Shifts
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" class="nav-link">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Logout
            </a>
        </li>

    </ul>
    <hr>
</div>


