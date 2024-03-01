@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
<section style="margin-left: 272px; margin-right: 30px">
    <h2> MANAGE DOCTORS </h2>
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Specialization</td>
            <td>Contact number</td>
            <td>Address</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @foreach($doctors as $doctor)
        <tr>
            <td> {{ $doctor -> id }}</td>
            <td> {{ $doctor -> name }}</td>
            <td> {{ $doctor -> gender_id }}</td>
            <td> {{ $doctor -> email }}</td>
            <td> {{ $doctor -> specialization }}</td>
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
    <button class="btn btn-primary" type="submit">
        <a class="nav-link" href="{{ route('doctor.create')}}">
            Add a doctor
        </a>
    </button>
</section>
