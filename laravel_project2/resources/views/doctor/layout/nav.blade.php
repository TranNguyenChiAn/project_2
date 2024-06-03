@vite(["resources/sass/app.scss", "resources/js/app.js"])
<style>
    .nav-link {
        color: #cecdcd;
    }

    .nav-link:hover{
        color: #2f2ffe;
    }
</style>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
</head>
<div class="d-flex flex-column flex-shrink-0 p-3" style="width: 200px;height: 100%;
        position: fixed;background-color: #c3dcdb">
    <div class="d-flex flex-column align-items-center mt-5">
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
    <ul class="nav nav-pills flex-column mb-auto justify-content-around"
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
        <li>
            <a href="{{ route('doctor.appointmentList') }}" class="nav-link text-dark">
                <i class="bi bi-person-circle"></i>
                Profile
            </a>
        </li>
        <li>
            <button class="btn rounded-3 text-white mt-2" data-bs-toggle="modal" data-bs-target="#addAppointment"
                    style="background-color: #2e7c76;">
                <a class="nav-link text-white p-0" style="font-size: 11px">
                    <i class="bi bi-plus"></i>
                    Create new appointment
                </a>
            </button>
            <div class="container mt-5" >
                <!-- Modal -->
                <div class="modal fade" id="addAppointment" tabindex="-1" role="dialog"
                     aria-labelledby="formModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title" id="formModalLabel">Form</h5>
                                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('appointment.storeForm')}}" id="info_form">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <span><b>Date:</b></span>
                                        <span id="display_date"></span><br>
                                        <span><b>Time: </b></span>
                                        <span id="display_time"></span>
                                        <input type="hidden" name="appointment_time" id="appointment_time">
                                        <input type="hidden" name="date" id="appointment_date">
                                        <input type="hidden" name="doctor_id" id="doctor_id">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Full name" required>
                                    </div>

                                    <div class="form-group mt-3">
                                        <input type="text" name="phone_number" class="form-control"
                                               placeholder="Phone number" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class=" align-content-center">Gender: </label>
                                        <input class="form-check-input" type="radio" name="gender_id" value="1" required checked> Male
                                        <input class="form-check-input" type="radio" name="gender_id" value="2"> Female
                                    </div>
                                    <div class="form-group mt-3">
                                        @php
                                            $td = strtotime("today");
                                            $maxToday = date("Y-m-d", $td);
                                        @endphp
                                        <label>Date birth</label>
                                        <input type="date" name="date_birth" max="{{$maxToday}}" class="form-control" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="insurance_number" placeholder="Insurance number" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="customer_notes" placeholder="Note" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>

</div>


