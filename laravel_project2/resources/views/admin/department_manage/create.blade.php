@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section class=" position-absolute start-50 translate-middle-x">
    <h1 align="center" style="font-weight: bold; margin-top: 30px;color: #2f2ffe;"> Add a department</h1>
    <br>
    <div class="row g-6 bg-white" style="width: 600px">
        <form class="col-12" method="post" action="{{ route('department.store') }}"
              style="padding: 10px 24px"
              enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 p-3">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name">
                @if($errors->has('name'))
                    {{ $errors->first('name') }}
                @endif<br>
            </div>
            <br>
            <div>
                <button class="btn btn-primary d-flex float-end">Add</button>
            </div>

        </form>
    </div>

</section>

