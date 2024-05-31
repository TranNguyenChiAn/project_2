@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section class="position-absolute start-50 translate-middle-x" style="font-size: 18px">
    <h1 align="center" style="font-weight: bold; color: #2f2ffe; margin-top: 30px"> EDIT DEPARTMENT</h1>
    <br>
    <div class="row g-3 bg-white">
        <form class="row g-3 bg-white" method="post" action="{{ route('department.update', $department)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $department->id }}">
            <div class="col-md-8">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{ $department->name }}"><br>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
</section>
