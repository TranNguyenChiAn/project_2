<div class="d-flex flex-column flex-shrink-0 p-3 bg-white                                           " style="width: 246px;height: 100%; position: absolute">
    <a href="/" class="d-flex align-items-center text-decoration-none">
        <svg class="bi me-2" width="32" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto justify-content-around">
        <li class="nav-item">
            <a href="#" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.doctor') }}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Doctors
            </a>
        </li>
        <li>
            <a href="{{ route('appointment.index') }}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Appointments
            </a>
        </li>
        <li>
            <a href="{{ route('customer.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Customers
            </a>
        </li>
        <li>
            <a href="{{ route('patient.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Patients
            </a>
        </li>
        <li>
            <a href="{{ route('specialization.index') }}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Specialization
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Logout
            </a>
        </li>

    </ul>
    <hr>
</div>
