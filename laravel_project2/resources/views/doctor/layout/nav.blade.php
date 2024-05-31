@vite(["resources/sass/app.scss", "resources/js/app.js"])
<style>
    .nav-link {
        color: #cecdcd;
    }

    .nav-link:hover{
        color: #2f2ffe;
    }
</style>
<div class="d-flex flex-column flex-shrink-0 p-3" style="width: 270px;height: 100%;
        position: fixed;background-color: #c3dcdb">
    <div class="d-flex justify-content-around align-items-center mt-5">
        <i class="fs-1 bi bi-person-circle"></i>
        <div class="d-block">
            <p class="text-dark m-0">
                <b>{{session('doctor.name')}}</b>
            </p>
            <p class="m-0" style="color:grey">
                {{session('doctor.email')}}
            </p>
        </div>

    </div>
    <br>
    <button class="btn btn-outline-info mb-4">
        <a href="{{ route('doctor.logout') }}" class="text-decoration-none">
            Logout
        </a>
    </button>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto justify-content-around text"
        style="font-weight: bold">
        <li class="nav-item">
            <a href="{{ route('doctor.schedule') }}" class="nav-link text-dark">
                <i class="bi bi-calendar"></i>
                Schedule
            </a>
        </li>
        <li>
            <a href="{{ route('doctor.appointmentList') }}" class="nav-link text-dark">
                <i class="bi bi-journal"></i>
                Appointments
            </a>
        </li>
    </ul>
</div>


