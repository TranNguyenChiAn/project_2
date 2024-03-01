@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<section style="margin-left: 300px">
    <form method="post" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
    @csrf
    Name: <input type="text" name="name">
    @if($errors->has('name'))
        {{ $errors->first('name') }}
    @endif<br>
    Gender: <input type="radio" name="gender" value="1"> Male
            <input type="radio" name="gender" value="2"> Female
    @if($errors->has('gender'))
        {{ $errors->first('gender') }}
    @endif<br>
    Email: <input type="text" name="email">
    @if($errors->has('email'))
        {{ $errors->first('email') }}
    @endif<br>
    Specialization: <input type="text" name="specialization">
    @if($errors->has('quantity'))
        {{ $errors->first('quantity') }}
    @endif<br>
    Contact number: <input type="number" name="contact_number">
    <br>
    <button class="btn btn-primary">Add</button>
</form>
</section>
