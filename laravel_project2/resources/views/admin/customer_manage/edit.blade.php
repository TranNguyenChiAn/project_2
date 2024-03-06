@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section style="margin-left: 300px">
    <div class="row g-3">
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> EDIT CUSTOMER </figure>
        <form class="row g-3 bg-white" method="post" action="{{ route('customer.update', $customer) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $customer->id }}">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{ $customer->name }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" value="{{ $customer->email  }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="phone" name="phone" value="{{ $customer->phone }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input class="form-control" type="text" name="address" value="{{ $customer->address }}"><br>
            </div>
            <div class="w-75 d-flex justify-content-end">
                <button class="btn btn-primary col-2" type="submit">Update</button>
            </div>
        </form>
    </div>
</section>
