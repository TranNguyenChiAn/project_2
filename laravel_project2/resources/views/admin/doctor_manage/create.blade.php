@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title> Create doctor</title>
<section class="position-absolute start-50 translate-middle-x" style="font-size: 14px; font-family: Inter">
    <h2 align="center" style="font-weight: bold;color: #2f2ffe; margin-top: 30px"> Add a doctor </h2>
    <div class="row g-6">
        <form class="row g-3 bg-white rounded-3" method="post" action="{{ route('doctor.store') }}" id="myForm"
              style="padding: 10px 24px"
              enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name" required
                value="{{old('name')}}">
                @if($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Email </label>
                <input class="form-control" placeholder="Email" type="email" name="email" required
                       value="{{old('email')}}">
                @if($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Password </label>
                <input class="form-control" placeholder="Password" type="password" name="password" required
                       value="{{old('password')}}">
            </div>
            @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
            <div class="col-md-6">
                <label class="form-label"> Gender:</label><br>
                    <input class="form-check-input" checked type="radio" name="gender_id" value="1"> Male
                    <input class="form-check-input" type="radio" name="gender_id" value="2"> Female
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="tel" name="contact_number"
                       placeholder="Contact number" maxlength="10" minlength="10" value="{{old('contact_number')}}">
            </div>
            @if($errors->has('contact_number'))
                <p class="text-danger">{{ $errors->first('contact_number') }}</p>
            @endif

            <div class="col-md-6">
                <label class="form-label"> Address </label>
                <input class="form-control" type="text" name="address" placeholder="Address" required
                       value="{{old('address')}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Department</label><br>
                <select class="form-select dropdown" name="department_id" required>
                    <option disabled selected> -- Choose --</option>
                    @foreach($departments as $department )
                        <option class="form-control" value="{{$department -> id}}"> {{$department -> name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shift</label><br>
                @foreach($shifts as $shift)
                    <input class="form-check-input" type="checkbox" name="shifts[]" value="{{$shift->id}}">
                    {{$shift->start_time}} - {{$shift->end_time}} <br>
                @endforeach
            </div>
            <div class="col-md-6">
                <label class="form-label">Consulting room</label><br>
                <select class="form-select dropdown">
                    <option disabled selected> -- Choose --</option>
                    @foreach($rooms as $room)
                        <option class="form-check-input" name="room_id" value="{{$room->id}}"> {{$room->room_name}}<br>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label><br>
                <select class="form-select dropdown">
                    <option class="form-check-input" name="status" value="0"> Active </option>
                    <option class="form-check-input" name="status" value="1"> Locked </option>
                    <option class="form-check-input" name="status" value="2"> Deleted </option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label"> Image:</label>
                <input type="file" class="form-control" name="image" id="imageFile"
                       accept="image/*" onchange="chooseFile(this)" required>
                <style>
                    #image img {
                        height: 150px;
                        margin:10px;
                    }
                </style>
                <div id="image">
                </div><br>
            </div>

            <button class="btn btn-primary" style="margin-top: 24px">Add</button>
        </form>
    </div>
</section>

<script type="text/javascript">
    function chooseFile() {
        let fileSelected = document.getElementById('imageFile').files;
        if (fileSelected.length > 0) {
            let fileToLoad = fileSelected[0];
            let fileReader = new FileReader();
            fileReader.onload = function(fileLoaderEvent) {
                let srcData = fileLoaderEvent.target.result;
                let newImage = document.createElement('img');
                newImage.src = srcData;

                document.getElementById('image').innerHTML = newImage.outerHTML;
            }
            fileReader.readAsDataURL(fileToLoad);
        }
    }
</script>
<script>
    const form = document.getElementById('myForm');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');

    form.addEventListener('submit', function (event) {
        let checkedCount = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                checkedCount++;
            }
        });

        if (checkedCount === 0) {
            alert('Vui lòng chọn ít nhất một ca làm việc.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

