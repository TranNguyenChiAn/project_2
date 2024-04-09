@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Manage patients</title>
<section style="margin-left: 260px; margin-right: 30px; padding: 18px">
    <h2> MANAGE PATIENT</h2>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date birth</th>
            <th>Gender</th>
            <th>Insurance number</th>
            <th>Phone number</th>
            <th>Address</th>
{{--            <th>Edit</th>--}}
{{--            <th>Delete</th>--}}
        </tr>
        @foreach($patients as $patient)
            <tr>
                <td> {{ $patient -> id }}</td>
                <td> {{ $patient -> name }}</td>
                <td> {{ $patient -> date_birth }}</td>
                <td> {{ $patient -> gender -> name }}</td>
                <td> {{ $patient -> insurance_number }}</td>
                <td> {{ $patient -> phone_number }}</td>
                <td> {{ $patient -> address }}</td>
{{--                <td>--}}
{{--                    <a class="nav-link link-primary" href="{{ route('doctor.edit', $patient)}}"> Edit </a>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <form method="post" action="{{ route('doctor.destroy', $patient)}}">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @endforeach
    </table>
    <br>
{{--    <div class=" d-flex justify-content-end">--}}
{{--        <button class="btn btn-primary" type="submit">--}}
{{--            <a class="nav-link" href="{{ route('pa.create')}}">--}}
{{--                Add a doctor--}}
{{--            </a>--}}
{{--        </button>--}}
{{--    </div>--}}

    <div class="d-flex justify-content-center">
        {{$patients->links()}}
    </div>

</section>
