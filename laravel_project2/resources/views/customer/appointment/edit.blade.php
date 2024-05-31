@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<title> Edit Appointment </title>
<section style="margin-left: 72px; margin-right: 30px; padding: 18px;">
    <h2 style="font-weight: bold" align="center"> MANAGE APPOINTMENTS </h2>
    <form action="{{route('customer.updateAppointment', $appointment)}}" class="form-control" method="post">
        @csrf
        @method('PUT')
        <table class="table mt-3 table-borderless">
            <tr>
                <th>ID</th>
                <th>Doctor's image</th>
                <th>Information</th>
                <th>Approval Status</th>
            </tr>
            <tr>
                <td>
                    <p>{{ $appointment -> id }} </p>
                </td>
                <td>
                    <img src="{{asset('./images/' . $appointment -> doctor->image)}}" class="rounded-circle"
                         style="object-fit: cover; object-position: top" width="120px" height="120px">
                </td>
                <td>
                    <p>
                        <b>Doctor: {{ $appointment-> doctor -> name }} - {{ $appointment-> doctor -> department ->name }}</b>
                    </p>

                    {{--                    Name--}}
                    <div class="d-flex justify-content-start align-items-center m-3">
                        <p class="m-0">Customer name:</p>
                        <input type="text" class="form-control w-50" name="customer_name" value=" {{ $appointment-> customer_name }}">
                    </div>

                    {{-- Gender --}}
                    <div class="m-3">
                        <span>Gender: </span>
                        @foreach($genders as $gender)
                            <input class="form-check-input" type="radio" name="gender_id"
                                   value="{{$gender->id}}" required
                            @if($appointment->gender_id == $gender->id)
                                {{'checked'}}
                                    @endif>
                            {{$gender -> name}}
                        @endforeach
                    </div>

                    {{-- Phone number --}}
                    <div class="d-flex justify-content-start align-items-center m-3">
                        <p class="m-0">Phone number: </p>
                        <input type="text" name="phone_number" class="form-control w-50"
                               placeholder="Phone number" required value="{{$appointment-> phone}}">
                    </div>

                    {{-- Date of birth --}}
                        @php
                            $td = strtotime("today");
                            $maxToday = date("Y-m-d", $td);
                        @endphp
                    <div class="d-flex justify-content-start align-items-center m-3">
                        <label class="m-0">Date birth</label>
                        <input type="date" name="date_birth" max="{{$maxToday}}" class="form-control w-50" required
                               value="{{$appointment-> date_birth}}">
                    </div>

                    {{-- Insurance number --}}
                    <div class="d-flex justify-content-start align-items-center m-3">
                        <label class="m-0">Insurance number: </label>
                        <input type="number" name="insurance_number"  class="form-control w-50"
                              minlength="10" maxlength="10" value="{{$appointment-> insurance_number}}">
                    </div>

                    {{-- Note --}}
                    <div class="d-flex justify-content-start align-items-center m-3">
                        <label class="m-0">Note: </label>
                        <input type="text" name="customer_notes" placeholder="Note" class="form-control w-50" value="{{$appointment-> note}}">
                    </div>

                    {{-- Room_id --}}
                    <input type="hidden" value="{{$appointment -> room_id}}">
                </td>
                <td>
                    @if( $appointment->approval_status == 1)
                        <div class="btn btn-warning" style="font-size: 12px; cursor: default"> Unconfirmed </div>
                    @elseif($appointment->approval_status == 2)
                        <div class="btn btn-success" style="font-size: 12px; cursor: default"> Confirmed </div>
                    @elseif($appointment->approval_status == 3)
                        <div class="btn btn-danger" style="font-size: 12px; cursor: default" data-bs-toggle="modal" data-bs-target="#undoCancel">
                            Canceled
                        </div>
                    @endif

                    <p class="mt-3 mb-0"><b> Payment status </b></p>
                        @if( $appointment->payment_status == 1)
                            <div class="btn btn-warning" style="font-size: 12px; cursor: default"> Not complete </div>
                        @elseif($appointment->payment_status == 2)
                            <div class="btn btn-success" style="font-size: 12px; cursor: default"> Complete </div>
                        @endif
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <button class="btn btn-primary float-end" type="submit">
                        <a class="nav-link text-white">
                            Update
                        </a>
                    </button>
                </td>
            </tr>
        </table>

        @if($appointment->approval_status == 1)
            <div class="btn btn-danger w-100 rounded-5" data-bs-toggle="modal" data-bs-target="#confirm">
                Cancel
            </div>
        @endif
    </form>
</section>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="formModalLabel">Confirm cancel</h5>
                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('customer.cancelAppointment', $appointment)}}">
                    @csrf
                    @method('put')
                    <p>Are you sure to want to cancel this appointment? </p>
                    <div class="btn btn-outline-success close" data-bs-dismiss="modal" aria-label="Close"> No </div>
                    <button class="btn btn-outline-danger"> Yes </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="undoCancel" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="formModalLabel">Undo cancel</h5>
                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('customer.undoCancel', $appointment)}}">
                    @csrf
                    @method('put')
                    <p>Are you sure to want to undo cancel this appointment? </p>
                    <div class="btn btn-outline-danger close" data-bs-dismiss="modal" aria-label="Close"> No </div>
                    <button class="btn btn-outline-success"> Yes </button>
                </form>
            </div>
        </div>
    </div>
</div>


