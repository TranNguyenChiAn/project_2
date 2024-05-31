@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<title>Manage appointments</title>
<section style="font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MY APPOINTMENTS </h2>
    <form action="{{route('appointment.update', $appointment)}}" class="form-control" method="post">
        @csrf
        @method('PUT')
        <table class="table mt-3 table-borderless">
            <tr>
                <th>ID</th>
                <th>Information</th>
                <th>Room</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>
                    <p>{{ $appointment -> id }} </p>

                </td>
                <td>
                    <p>Doctor: {{ $appointment-> doctor->name }}</p>
                    <p>Customer name: {{ $appointment-> customer_name }}</p>
                    <p>Date: {{ $appointment-> date }}</p>
                    <p>Time: {{ $appointment-> time }}</p>
                    <p>Note: {{ $appointment-> note }}</p>
                </td>
                <td>
                    @if($appointment-> room_id != 0)
                        <p> {{$appointment-> room ->room}}</p>
                    @else
                        <p>Null</p>
                    @endif
                </td>
                <td>
                    @if($appointment->status== 1)
                        <button class="btn btn-warning" value="1"> Unconfirmed</button>
                    @elseif($appointment->status== 2)
                        <button class="btn btn-success" value="2"> Confirmed </button>
                    @elseif($appointment->status== 3)
                        <button class="btn btn-danger" value="3"> Canceled </button>
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
    </form>
</section>