@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Edit shift</title>
<section class="position-absolute start-50 translate-middle-x" style="font-size: 18px">
    <h1 align="center" style="font-weight: bold; color: #2f2ffe; margin-top: 30px"> EDIT SHIFT </h1>
    <br>
    <div class="row g-3">
        <form class="row bg-white rounded-3 p-lg-3" method="post" action="{{ route('shift.update', $shift)}}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $shift->id }}">
            <div class="col-md-8">
                <label class="form-label">Start time</label>
                <input class="form-control" type="time" name="start_time" value="{{ $shift-> start_time }}"><br>
            </div>
            <div class="col-md-8">
                <label class="form-label">End time</label>
                <input class="form-control" type="time" name="end_time" value="{{ $shift-> end_time }}">
            </div>
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
</section>
