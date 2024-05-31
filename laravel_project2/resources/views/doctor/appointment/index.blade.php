@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('doctor.layout.nav')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2" defer></script>
<title>Doctor appointments</title>
<section style="margin-left: 276px; margin-right: 30px; padding: 18px; background-color: white" class="vh-100">
    <form method="get" action="{{ route('doctor.index') }}" class="d-flex justify-content-between" role="search"
          style="width: 360px">
        @csrf
        <input class="form-control p-2 px-3" name="search" type="text" aria-label="Search"
               placeholder="Type to search..." style="width: 300px">
        <button class="btn btn-primary ml-3" type="submit"> Search </button>
    </form>
    <div class="d-flex justify-content-between mt-5">
        <h5 style="font-weight: bold"> All appointments </h5>
        <button class="btn btn-primary float-end" type="submit">
            <a class="nav-link text-white" href="{{ route('appointment.create')}}">
                + Add an appointment
            </a>
        </button>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <table class="table table-borderless" style="font-size: 12px">
                <tr class="border-bottom border-primary">
                    <th>ID</th>
                    <th>Doctor</th>
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
                        <td> {{ $appointment-> doctor->name }}</td>
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
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-between">
                                        <h5 class="modal-title" id="formModalLabel">Detail </h5>
                                        <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><b>Appointment ID: </b> {{ $appointment -> id }}</p>
                                        <p><b>Doctor: </b>  {{ $appointment-> doctor->name }}</p>
                                        <p><b>Customer's name: </b>  {{ $appointment-> customer_name }}</p>
                                        <p><b>Date of birth: </b>  {{ $appointment-> date_birth }}</p>
                                        <p><b>Gender: </b>  {{ $appointment-> gender->name }}</p>
                                        <p><b>Insurance number: </b>  {{ $appointment-> insurance_number }}</p>
                                        <p><b>Phone number: </b>  {{ $appointment-> phone }}</p>
                                        <p><b>Appointment date: </b>  {{ $appointment-> date }}</p>
                                        <p><b>Appointment time: </b>  {{ $appointment-> time  }}</p>
                                        <p><b>Room: </b>  {{ $appointment-> room -> room  }}</p>
                                        <div class="">
                                            @if( $appointment->status == 1)
                                                <button class="btn btn-warning"> Unconfirmed </button>
                                            @elseif($appointment->status == 2)
                                                <button class="btn btn-success"> Confirmed </button>
                                            @elseif($appointment->status == 3)
                                                <button class="btn btn-danger"> Canceled </button>
                                            @endif
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
</section>

<x-flash-message/>