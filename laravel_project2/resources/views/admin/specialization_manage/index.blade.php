@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
<section style="margin-left: 272px; margin-right: 30px">
    <h2> MANAGE DOCTORS </h2>
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @foreach($specialization as $specialization)
            <tr>
                <td> {{ $specialization -> id }}</td>
                <td> {{ $specialization -> name }}</td>
                <td>
                    <a class="nav-link link-primary" href=""> Edit </a>
                </td>
                <td>
                    <form method="post" action="">
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
        <a class="nav-link" href="">
            Add a Specialization
        </a>
    </button>
</section>