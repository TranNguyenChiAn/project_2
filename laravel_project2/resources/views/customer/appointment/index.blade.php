@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<title>My appointments</title>
<section style=" font-family: Inter" class="m-5">
    <h2 style="font-weight: bold" align="center"> MY APPOINTMENTS </h2>
    <table class="table table-striped mt-3" style="font-size: 12px">
        <tr>
            <th>ID</th>
            <th>Doctor</th>
            <th>Customer's information</th>
            <th>Date</th>
            <th>Time</th>
            <th>Approval Status</th>
            <th>View</th>
            <th>Edit</th>
        </tr>
        @foreach($appointments as $appointment)
            <tr>
                <td> {{ $appointment -> id }}</td>
                <td> {{ $appointment-> doctor->name }}</td>
                <td> {{ $appointment-> customer_name }}</td>
                <td> {{ $appointment-> date }}</td>
                <td> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i A') }}</td>
                <td>
                    @if( $appointment->approval_status == 1)
                        <button class="btn btn-warning" style="font-size: 12px"> Unconfirmed </button>
                    @elseif($appointment->approval_status == 2)
                        <button class="btn btn-success" style="font-size: 12px"> Confirmed </button>
                    @elseif($appointment->approval_status == 3)
                        <button class="btn btn-danger" style="font-size: 12px"> Canceled </button>
                    @endif
                </td>
                <td>
                    <button class="btn btn-secondary btn-view" data-bs-toggle="modal" data-bs-target="#formModal{{$appointment->id}}">
                        <i class="bi bi-eye"></i>
                    </button>
                </td>
                <td>
                    <a class="nav-link link-primary" href="{{ route('customer.editAppointment', $appointment)}}" >
                        Edit
                    </a>
                </td>
            </tr>
            <div class="container mt-5">
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
                                <p class="m-2"> <b>Personal information</b></p>
                                <div class="card">
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
                                                        {{ session('customer.email') }}
                                                    </i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mt-2 m-0">
                                            <div class="card-body m-0 p-2 rounded-3" style="background-color: #f4f5f8">
                                                My notes: <p class="m-0"><b>{{ $appointment -> customer_notes}}</b></p>
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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p>
                                                <b>Doctor: </b><br>
                                                {{ $appointment-> doctor->name }} - {{ $appointment-> doctor-> department -> name}}
                                            </p>
                                            <p><b>Date: </b> <br>
                                                {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('l, jS F Y') }},
                                                {{ \Carbon\Carbon::parse($appointment->time)->format('H:i A') }}
                                            </p>
                                        </div>

                                        <span>
                                            <b>Room: </b>
                                            @if($appointment-> room -> room == 0)
                                                 Pending
                                            @else
                                                {{ $appointment-> room -> room  }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <p class="mt-3 m-2"> <b>Status</b></p>
                                <div class="card">
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
                                            @if( $appointment->payment_status == 1 and $appointment->approval_status == 1)
                                                <span class="text-danger"> Not complete </span>
                                                <a href="{{ route('customer.payment', $appointment)}}">
                                                    Complete now
                                                </a>
                                            @elseif($appointment->payment_status == 2)
                                                <span class="text-success"> Completed </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </table>
    <br>
    <div class="d-flex justify-content-center pt-3 w-10">
        {{$appointments->links()}}
    </div>
</section>

@include('customer.layout.footer')