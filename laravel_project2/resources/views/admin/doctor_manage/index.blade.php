@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
<section style="margin-left: 260px; margin-right: 30px; padding: 18px">
    <h2> MANAGE DOCTORS </h2>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Specialization</th>
            <th>Gender</th>
            <th>Contact number</th>
            <th>Address</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($doctors as $doctor)
        <tr>
            <td> {{ $doctor -> id }}</td>
            <td> {{ $doctor -> name }}</td>
            <td> {{ $doctor -> email }}</td>
            <td>
                <img src="{{ asset('./images/'. $doctor->image)}}"
                     style="height: 100px; object-fit: cover">
            </td>
            <td> {{ $doctor -> specialization -> name }}</td>
            <td> {{ $doctor -> gender -> name }}</td>
            <td> {{ $doctor -> contact_number }}</td>
            <td> {{ $doctor -> address }}</td>
            <td>
                <a class="nav-link link-primary" href="{{ route('doctor.edit', $doctor)}}"> Edit </a>
            </td>
            <td>
                <form method="post" action="{{ route('doctor.destroy', $doctor)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <br>
    <div class=" d-flex justify-content-end">
        <button class="btn btn-primary" type="submit">
            <a class="nav-link" href="{{ route('doctor.create')}}">
                Add a doctor
            </a>
        </button>
    </div>

    <div class="pt-3 w-10">
        {{$doctors->links()}}
    </div>

</section>
