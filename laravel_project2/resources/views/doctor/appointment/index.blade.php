@vite(["resources/sass/app.scss", "resources/js/app.js"])

<title>Manage appointments</title>
<section style=" font-family: Inter" class="m-5">
    <div class="avatar me-3">
        <img class="avatar-img rounded-circle shadow" src="{{ asset('./images/' . $doctor->image) }}"
             alt="avatar" height="50px">
        <p> {{session('doctor.name')}}</p>
    </div>
    <h2 style="font-weight: bold" align="center"> MANAGE APPOINTMENTS </h2>
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Doctor</th>
            <th>Customer's information</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        @foreach($appointments as $appointment)
            <tr>
                <td> {{ $appointment -> id }}</td>
                <td> {{ $appointment-> doctor->name }}</td>
                <td> {{ $appointment-> customer_name }}</td>
                <td> {{ $appointment-> date }}</td>
                <td> {{ $appointment-> time }}</td>
                <td>
                    @if( $appointment->status == 1)
                        <button class="btn btn-warning"> Unconfirmed </button>
                    @elseif($appointment->status == 2)
                        <button class="btn btn-success"> Confirmed </button>
                    @elseif($appointment->status == 3)
                        <button class="btn btn-danger"> Canceled </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    <div class="d-flex justify-content-center pt-3 w-10">
        {{$appointments->links()}}
    </div>
</section>