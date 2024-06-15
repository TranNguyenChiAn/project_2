@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Manage consulting room</title>
<section style="margin-left: 272px; margin-right: 30px;padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE ROOMS </h2>
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</td>
            <th>Floor</th>
            <th>Room name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($rooms as $room)
            <tr>
                <td> {{ $room-> id }}</td>
                <td> {{ $room-> floor }}</td>
                <td> {{ $room -> room_name }}</td>
                <td>
                    <a class="nav-link link-primary" href="{{ route('room.edit', $room)}}">
                        Edit
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('room.destroy', $room)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center pt-3 w-10">
        {{$rooms->links()}}
    </div>
    <button class="btn btn-primary float-end" type="submit">
        <a class="nav-link text-white" href="{{ route('room.create')}}">
            + Add a room
        </a>
    </button>

</section>
