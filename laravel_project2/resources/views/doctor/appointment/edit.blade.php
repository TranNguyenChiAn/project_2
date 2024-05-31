@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('doctor.layout.nav')

<title> Edit Appointment </title>
<section style="margin-left: 272px; margin-right: 30px; padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE APPOINTMENTS </h2>
    <form action="{{route('doctor.updateAppointment', $appointment)}}" class="form-control" method="post">
        @csrf
        @method('PUT')
        <table class="table mt-3 table-borderless">
            <tr>
                <th>ID</th>
                <th>Information</th>
                <th>Room</th>
                <th>Approval Status</th>
                <th>Appointment Status</th>
            </tr>
            <tr>
                <td>
                    <p>{{ $appointment -> id }} </p>

                </td>
                <td>
                    <p>Doctor: {{ $appointment-> doctor -> name }}</p>
                    <p>Customer name: {{ $appointment-> customer_name }}</p>
                    <p>Date: {{ $appointment-> date }}</p>
                    <p>Time: {{ $appointment-> time }}</p>
                    <p>Note: {{ $appointment-> note }}</p>
                </td>
                <td>
                    <select name="room_id" class="form-select dropdown">
                        @foreach($rooms as $room)
                            <option value="{{$room->id}}"
                            @if($room->id == $appointment->room_id)
                                {{'selected'}}
                                    @endif
                            > {{$room -> room}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="approval_status" class="form-select dropdown">
                        @if($appointment->approval_status== 1)
                            <option value="1"> Unconfirmed</option>
                            <option value="2"> Confirmed </option>
                            <option value="3"> Canceled </option>
                        @elseif($appointment->approval_status == 2)
                            <option value="1"> Confirmed</option>
                            <option value="2"> Unconfirmed </option>
                            <option value="3"> Canceled </option>
                        @elseif($appointment->approval_status == 3)
                            <option value="3"> Canceled </option>
                            <option value="1"> Confirmed</option>
                            <option value="2"> Unconfirmed </option>
                        @endif
                    </select>
                </td>
                <td>
                    <select name="appointment_status" class="form-select dropdown">
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
    </form>
</section>

