@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Manage shifts</title>
<section style="margin-left: 260px; margin-right: 30px; padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE SHIFTS </h2>
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Star time</th>
            <th>End time</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($shifts as $shift)
            <tr>
                <td> {{ $shift-> id }}</td>
                <td> {{ $shift -> start_time }}</td>
                <td> {{ $shift -> end_time }}</td>
                <td>
                    <a class="nav-link link-primary" href="{{ route('shift.edit', $shift)}}"> Edit </a>
                </td>
                <td>
                    <form method="post" action="{{ route('shift.destroy', $shift)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary" type="submit" href="{{ route('shift.create')}}">
            + Add a shift
        </a>
    </div>

    <div class="d-flex justify-content-center">
        {{$shifts->links()}}
    </div>

</section>
