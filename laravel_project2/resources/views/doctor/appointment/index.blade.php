@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('doctor.layout.nav')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2" defer></script>
<title>Doctor appointments</title>
<section style="margin-left: 190px; padding: 18px; background-color: white">
    <div class="d-flex justify-content-between mt-3">
        <h5 style="font-weight: bold"> All appointments </h5>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <table class="table table-borderless" style="font-size: 12px">
                <tr class="border-bottom border-primary">
                    <th>ID</th>
                    <th>Customer's information</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Approval Status</th>
                    <th>Appointment Status</th>
                    <th>View</th>
                    <th>Edit</th>
                </tr>
                @foreach($appointments as $appointment)
                    <tr>
                        <td> {{ $appointment -> id }}</td>
                        <td> {{ $appointment-> customer_name }}</td>
                        <td> {{ $appointment-> date }}</td>
                        <td> {{ $appointment-> time  }}</td>
                        <td >
                            @if( $appointment->approval_status == 1)
                                <button class="btn btn-warning" style="font-size: 12px"> Unconfirmed </button>
                            @elseif($appointment->approval_status == 2)
                                <button class="btn btn-success" style="font-size: 12px"> Confirmed </button>
                            @elseif($appointment->approval_status == 3)
                                <button class="btn btn-danger" style="font-size: 12px"> Canceled </button>
                            @endif
                        </td>
                        <td>
                            @if( $appointment->appointment_status == 1)
                                <button class="btn btn-warning" style="font-size: 12px"> Not complete </button>
                            @elseif($appointment->appointment_status == 2)
                                <button class="btn btn-success" style="font-size: 12px"> Completed </button>
                            @elseif($appointment->appointment_status == 3)
                                <button class="btn btn-secondary" style="font-size: 12px"> Customer not available </button>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target="#formModal{{$appointment->id}}">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                        <td>
                            <a class="nav-link link-primary" href="{{ route('doctor.editAppointment', $appointment)}}" >
                                Edit
                            </a>
                        </td>
                    </tr>
                    <div class="container">
                        <!-- Modal -->
                        <div class="modal fade" id="formModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="font-size: 9px">
                                    <div class="modal-header d-flex justify-content-between">
                                        <h6 class="modal-title" id="formModalLabel">
                                            <b>Appointment ID: </b> #{{ $appointment -> id }}
                                        </h6>
                                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p> <b>Customer's information</b></p>
                                        <div class="card bg-white">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start">
                                                    <i class="bi bi-person-circle fs-1"></i>
                                                    <div class="mx-lg-2">
                                                        <b>{{ $appointment-> customer_name }}</b>
                                                        <div class="d-flex justify-content-between  text-secondary">
                                                            <i class="bi bi-telephone">
                                                                {{ $appointment-> phone }}
                                                            </i>
                                                            <i class="bi bi-envelope mx-lg-5">
                                                                @if($appointment-> customer->email != null)
                                                                    {{ $appointment-> customer->email }}
                                                                @else
                                                                    <p>Empty</p>
                                                                @endif

                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mt-2 m-0">
                                                    <div class="card-body m-0 p-2 rounded-3" style="background-color: #f4f5f8">
                                                        Customer's notes: <p class="m-0"><b>{{ $appointment -> customer_notes}}</b></p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mt-2">
                                                    <span><b>Insurance number: <br>{{ $appointment-> insurance_number }} </b></span>
                                                    <div class="mx-lg-5">
                                                        <i class="bi bi-cake2">
                                                            <b>{{ $appointment-> date_birth }}</b>
                                                        </i><br>

                                                        <i class="bi bi-gender-ambiguous">
                                                            <b>{{ $appointment-> gender->name }}</b>
                                                        </i>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <p class="mt-3 m-2"> <b>Appointment information</b></p>
                                        <div class="card bg-white">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <p>
                                                        <b>Doctor: </b><br>
                                                        {{ $appointment-> doctor->name }} - {{ $appointment-> doctor-> department -> name}}
                                                    </p>
                                                    <p> <b>Room: </b><br>
                                                        {{$appointment-> doctor -> room -> room_name }}
                                                    </p>
                                                    <p><b>Date: </b> <br>
                                                        {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('l, jS F Y') }},
                                                        {{ \Carbon\Carbon::parse($appointment->time)->format('H:i A') }}
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>
                                                        <b>Doctor's notes: </b><br>
                                                        {{ $appointment-> doctor_notes}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="mt-3 m-2"> <b>Status</b></p>
                                        <div class="card bg-white">
                                            <div class="card-body">
                                                <div class="">
                                                    <b>Approval status:</b>
                                                    @if( $appointment->approval_status == 1)
                                                        <span class="text-warning" > Unconfirmed </span>
                                                    @elseif($appointment->approval_status == 2)
                                                        <span class="text-success"> Confirmed </span>
                                                    @elseif($appointment->approval_status == 3)
                                                        <span class="text-danger"> Canceled </span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <b>Payment status:</b>
                                                    @if( $appointment->payment_status == 1)
                                                        <span class="text-danger"> Not complete </span
                                                    @elseif($appointment->payment_status == 2)
                                                        <span class="text-success"> Completed </span>
                                                    @endif
                                                </div>
                                                @if($appointment->payment_status == 2)
                                                    <div>
                                                        <b>Payment method:</b>
                                                        @if( $appointment->payment_method == 4)
                                                            <span class="text-primary"> VN Pay </span>
                                                        @elseif($appointment->payment_method == 2)
                                                            <span class="text-success"> Completed </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </table>

        </div>
    </div>
    <div class="d-flex justify-content-center pt-3 w-10">
        {{$appointments->links()}}
    </div>
    <br>
{{--    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addAppointment">--}}
{{--        + Add an appointment--}}
{{--    </button>--}}
    <div class="mt-5" >
        <!-- Modal -->
        <div class="modal fade" id="addAppointment" tabindex="-1" role="dialog"
             aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="formModalLabel">Appointment form</h5>
                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('doctor.storeAppointment')}}" id="info_form">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <span><b>Date:</b></span>
                                <input type="date" name="date" class="form-control" required>
                                <span><b>Time: </b></span>
                                <input type="time" name="time" class="form-control" required>
                                <input type="hidden" name="doctor_id" id="doctor_id">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" id="name" name="customer_name"
                                       placeholder="Full name" required>
                            </div>

                            <div class="form-group mt-3">
                                <input type="tel" name="phone_number" class="form-control"
                                       placeholder="Phone number" required minlength="10" maxlength="10">
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
                                <input type="text" name="insurance_number" placeholder="Insurance number"
                                       minlength="10" maxlength="10" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="customer_notes" placeholder="Note" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 d-flex float-end">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-flash-message/>