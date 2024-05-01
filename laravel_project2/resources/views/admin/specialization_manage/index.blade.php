@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Manage specialization</title>
<section style="margin-left: 272px; margin-right: 30px;padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE SPECIALIZATIONS </h2>
    <table class="table table-striped mt-3">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @foreach($specializations as $specialization)
            <tr>
                <td> {{ $specialization -> id }}</td>
                <td> {{ $specialization -> name }}</td>
                <td>
                    <a class="nav-link link-primary" href="{{ route('specialization.edit', $specialization)}}">
                        Edit
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('specialization.destroy', $specialization)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center pt-3 w-10">
        {{$specializations->links()}}
    </div>
    <button class="btn btn-primary float-end" type="submit">
        <a class="nav-link text-white" href="{{ route('specialization.create')}}">
            + Add a specialization
        </a>
    </button>

</section>
