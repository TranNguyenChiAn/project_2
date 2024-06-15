@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
@include('admin.layout.menu')

<style>
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    body{
        background-color:whitesmoke;
    }

</style>

<title>Manage doctors</title>
<section  style="margin: 18px 0 0 264px">
    <div class="card" style="width: 98%">
        <div class="card-body border-0">
{{--            titlle--}}
            <div class="d-flex justify-content-between my-3">
                <h3 style="font-weight: bold"> Manage Doctors </h3>

{{--                add new button--}}
                <button class="btn btn-primary rounded-5" type="submit">
                    <a class="nav-link text-white px-2" href="{{ route('doctor.create')}}">
                        + Add a doctor
                    </a>
                </button>
            </div>

            <table class="table table-hover mt-3" style="font-size:12px; background-color: white">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Contact number</th>
                    <th>Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach($doctors as $doctor)
                    <tr>
                        <td> {{ $doctor -> id }}</td>
                        <td>
                            <img class="rounded-circle" height="60px" width="60px"
                                 src="{{ asset('./images/'. $doctor->image)}}"
                                 style="object-fit: cover; object-position: top">
                        </td>
                        <td> {{ $doctor -> name }}</td>
                        <td> {{ $doctor -> email }}</td>
                        <td> {{ $doctor -> department -> name }}</td>
                        <td> {{ $doctor -> contact_number }}</td>
                        <td> {{ $doctor -> address }}</td>
                        <td>
                            <a class="nav-link link-primary" href="{{ route('doctor.edit', $doctor)}}">
                                <i class="bi bi-magic h4"></i>
                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('doctor.destroy', $doctor)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">
                                    <i class="bi bi-x-circle" style="color: red"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center pt-3 w-10">
                {{$doctors->links()}}
            </div>
        </div>
    </div>
    <br>
</section>

