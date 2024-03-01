@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section style="margin-left: 300px">
    <div class="row g-3">
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> EDIT </figure>
        <form class="row g-3 bg-white" method="post" action="{{ route('doctor.update', $doctor)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $doctor->id }}">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{ $doctor->name }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" value="{{ $doctor->email  }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Specialization</label>
                <input class="form-control" type="text" name="specialization" value="{{ $doctor->specialization }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="number" name="contact_number" value="{{ $doctor->contact_number }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input class="form-control" type="text" name="address" value="{{ $doctor->address }}"><br>
            </div>
            <div class="w-75 d-flex justify-content-end">
                <button class="btn btn-primary col-2">Update</button>
            </div>
            <div></div>
        </form>
    </div>
</section>
