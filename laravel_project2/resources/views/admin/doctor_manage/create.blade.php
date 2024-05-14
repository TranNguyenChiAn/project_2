@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title> Create doctor</title>
<section class="position-absolute start-50 translate-middle-x" style="font-size: 14px; font-family: Inter">
    <h2 align="center" style="font-weight: bold;color: #2f2ffe; margin-top: 30px"> Add a doctor </h2>
    <div class="row g-6">
        <form class="row g-3 bg-white rounded-3" method="post" action="{{ route('doctor.store') }}"
              style="padding: 10px 24px"
              enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name">
                @if($errors->has('name'))
                    {{ $errors->first('name') }}
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Email </label>
                <input class="form-control" placeholder="Email" type="email" name="email">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Password </label>
                <input class="form-control" placeholder="Password" type="password" name="password">
            </div>
            <div class="col-md-6">
                <label class="form-label"> Gender:</label><br>
                @foreach($genders as $gender)
                    <input class="form-check-input" checked type="radio" name="gender_id" value="{{ $gender -> id}}"> {{ $gender -> name}}
                @endforeach
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="phone" name="contact_number" placeholder="Contact number">
            </div>

            <div class="col-md-6">
                <label class="form-label"> Address </label>
                <input class="form-control" type="address" name="address" placeholder="Address">
            </div>
            <div class="col-md-6">
                <label class="form-label">Specialization</label><br>
                <select class="form-select dropdown" name="specialization_id" required>
                    <option disabled selected> -- Choose --</option>
                    @foreach($specialization as $specialization)
                        <option class="form-control" value="{{$specialization -> id}}"> {{$specialization -> name}} </option>
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
                <label class="form-label"> Image:</label>
                <input type="file" class="form-control" name="image" id="imageFile"
                       accept="image/*" onchange="chooseFile(this)" required >
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
