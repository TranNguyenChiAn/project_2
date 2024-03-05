@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section style="margin-left: 300px">
    <div class="row g-3">
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> Add a doctor </figure>
        <form class="row g-3" method="post" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name">
                @if($errors->has('name'))
                    {{ $errors->first('name') }}
                @endif<br>
            </div>
            <div class="col-md-4">
                <label class="form-label">Email </label>
                <input class="form-control" placeholder="Email" type="email" name="email">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif<br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Password </label>
                <input class="form-control" placeholder="Password" type="password" name="password">
            </div>
            <div class="col-md-4">
                <label class="form-label"> Gender:</label>
                @foreach($genders as $gender)
                    <input type="radio" name="gender_id" value="{{ $gender -> id}}" required> {{ $gender -> name}}
                @endforeach

            </div>
            <div class="col-md-5">
                <label class="form-label">Specialization</label>
                <select class="form-control dropdown" required name="specialization_id">
                    <option> --Choose-- </option>
                    @foreach($specialization as $specialization)
                        <option value="{{ $specialization -> id}}"> {{ $specialization -> name}} </option>
                    @endforeach
                </select>

            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="phone" name="contact_number">
            </div>
            <br>
            <div class="col-md-6">
                <label class="form-label"> Address </label>
                <input class="form-control" type="address" name="address">
            </div>
            <br>
            <button class="md-4 btn btn-primary end-50">Add</button>
        </form>
    </div>

</section>
