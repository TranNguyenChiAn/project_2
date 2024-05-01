@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section class="position-absolute start-50 translate-middle-x" style="font-size: 18px; font-family: Inter">
    <h2 align="center" style="font-weight: bold; color: #2f2ffe; margin-top: 30px"> Create a shift </h2>
    <div class="row g-3 mt-2">
        <form class="row g-3 bg-white rounded-3" method="post" action="{{ route('shift.store')}}"
              enctype="multipart/form-data" id="uploadForm">
            @csrf
            @method('POST')
            <div class="col-md-6">
                <label class="form-label">Start time</label>
                <input class="form-control" type="time" name="start_time"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">End time</label>
                <input class="form-control" type="time" name="end_time"><br>
            </div>
            <button class="btn btn-primary float-end" type="submit"> Add </button>

        </form>
    </div>
</section>


