@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
<title>Manage doctors</title>
<section style="margin-left: 260px; margin-right: 30px; padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE DOCTORS </h2>
    <table class="table table-hover mt-3" style="font-size:13px">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Specialization</th>
            <th>Contact number</th>
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
                     style="height: 80px; object-fit: cover">
            </td>
            <td> {{ $doctor -> specialization -> name }}</td>
            <td> {{ $doctor -> contact_number }}</td>
            <td>
                <a class="nav-link link-primary" href="{{ route('doctor.edit', $doctor)}}">
                    <i class="bi bi-magic h4"></i>
                </a>
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

    <div class="d-flex justify-content-center pt-3 w-10">
        {{$doctors->links()}}
    </div>

    <div class=" d-flex justify-content-end">
        <button class="btn btn-primary" type="submit">
            <a class="nav-link text-white" href="{{ route('doctor.create')}}">
                + Add a doctor
            </a>
        </button>
    </div>

</section>
