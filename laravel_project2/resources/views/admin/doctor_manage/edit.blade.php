@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title> Edit doctor</title>
<section class="position-absolute start-50 translate-middle-x" style="font-size: 18px; font-family: Inter">
    <h2 align="center" style="font-weight: bold; color: #2f2ffe; margin-top: 30px"> EDIT DOCTOR </h2>
    <div class="row g-3">
        <form class="row g-3 fs-6 bg-white rounded-3" method="post" action="{{ route('doctor.update', $doctor, $shifts)}}"
              enctype="multipart/form-data" id="uploadForm">
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
                <select class="form-select dropdown" type="text" name="specialization" >
                    <option disabled selected> -- Choose -- </option>
                    @foreach($specialization as $specialization)
                        <option value="{{ $specialization->id }}"
                        @if($doctor->specialization_id == $specialization->id)
                            {{ 'selected' }}
                            @endif
                        >
                        {{ $specialization -> name}}
                    @endforeach
                </select><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="number" name="contact_number"
                       value="{{ $doctor->contact_number }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input class="form-control" type="text" name="address" value="{{ $doctor-> address }}">
            </div>
            <div class="col-md-6">
                <br>
                <label class="form-label"> Gender:</label>
                @foreach($genders as $gender)
                    <input class="form-check-input" type="radio" name="gender"
                           value="{{ $gender -> id}}"
                    @if($doctor->gender_id == $gender->id)
                        {{ 'checked' }}
                            @endif
                    > {{ $gender -> name}}
                @endforeach
            </div>
            <div class="col-md-6">
                <label class="form-label">Shift</label><br>
                @foreach($shifts as $shift)
                    <input class="form-check-input" type="checkbox" name="shifts[]" value="{{$shift->id}}"
                    @foreach($shift_details as $shift_detail)
                        @if($shift->id == $shift_detail->shift_id)
                            {{ 'checked' }}
                        @endif
                    @endforeach
                    <p>{{$shift-> start_time}} - {{$shift-> end_time}}</p><br>
                @endforeach
            </div>
            <div class="col-md-5">
                <label class="form-label"> Image:</label>
                <input class="form-control" type="file" name="image" id="imageFile"
                       accept="image/*" onchange="chooseFile(this)">
                <style>
                    #imageUpload img {
                        height: 150px;
                        margin-top: 10px;
                    }
                </style>
                <div id="imageUpload">
                    <img src="{{ asset('./images/' . $doctor->image) }}">
                </div>
            </div>

            <br>
            <button class="btn btn-primary float-end fs-6" type="submit">Update</button>

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


