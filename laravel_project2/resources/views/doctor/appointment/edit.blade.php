@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('doctor.layout.nav')

<title> Edit Appointment </title>
<section style="margin-left: 272px; margin-right: 30px; padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE APPOINTMENTS </h2>
    <form action="{{route('doctor.updateAppointment', $appointment)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row mt-3">
            <div class="col-md-8" style="font-size: 11px">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="modal-title" id="formModalLabel">
                                <b>Appointment ID: </b> #{{ $appointment -> id }}
                            </h6>
                        </div>
                        <p class="m-2"> <b>Customer's information</b></p>
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
                                                @if($appointment-> customer -> email != null)
                                                    {{ $appointment-> customer -> email }}
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
                                        {{$appointment-> doctor -> room -> room_name}}
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
        <div class="col-md-4">
            <form action="{{route('appointment.update', $appointment)}}" method="post">
                @csrf
                @method('PUT')
                <select name="approval_status" class="form-select dropdown">
                    @if($appointment->approval_status== 1)
                        <option value="1"> Unconfirmed</option>
                        <option value="2"> Confirmed </option>
                    @if($appointment->payment_status== 1)
                            <option value="3"> Canceled </option>
                    @endif
                    @elseif($appointment->approval_status == 2)
                        <option value="1"> Confirmed</option>
                        <option value="2"> Unconfirmed </option>
                        @if($appointment->payment_status== 1)
                            <option value="3"> Canceled </option>
                        @endif
                    @elseif($appointment->approval_status == 3)
                        <option value="3"> Canceled </option>
                        <option value="1"> Confirmed</option>
                        <option value="2"> Unconfirmed </option>
                    @endif
                </select>

                <select name="appointment_status" class="form-select dropdown mt-4">
                    @if($appointment->appointment_status== 1)
                        <option value="1"> Not complete</option>
                        <option value="2"> Complete </option>
                        <option value="3"> Customer not available </option>
                    @elseif($appointment->appointment_status == 2)
                        <option value="2"> Complete </option>
                        <option value="1"> Not complete</option>
                        <option value="3"> Customer not available </option>
                    @elseif($appointment->appointment_status == 3)
                        <option value="3"> Customer not available </option>
                        <option value="2"> Complete </option>
                        <option value="1"> Not complete</option>
                    @endif
                </select>

                <textarea placeholder="Doctor's notes" class="form-control mt-4" name="doctor_notes"></textarea>
                <button class="btn btn-primary mt-3 text-white d-flex float-end" type="submit">
                    Update
                </button>
            </form>
        </div>
    </form>
</section>

