@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
                <label class="form-label">Address</label>
                <input class="form-control" type="text" name="address" value="{{ $doctor-> address }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="number" name="contact_number"
                       value="{{ $doctor->contact_number }}"><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Department</label>
                <select id="department_select" class="form-select dropdown" type="text" name="department_id" >
                    <option disabled selected> -- Choose -- </option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                        @if($doctor->department_id == $department->id)
                            {{ 'selected' }}
                            @endif
                        >
                        {{ $department -> name}}
                    @endforeach
                </select><br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Consulting room</label><br>
                <select id="room_select" class="form-select dropdown" type="text" name="room_id" >
                    <option disabled selected> -- Choose -- </option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}"
                        @if($doctor->room_id == $room->id)
                            {{ 'selected' }}
                                @endif
                        >
                            Floor {{ $room -> floor}}, {{ $room -> room_name}}
                    @endforeach
                </select><br>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>

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
    $('#department_select').change(function(){
        let department = $(this).val();
        $.ajax({
            url: '/get-rooms/' + department,
            type: 'GET',
            success: function(response){
                $('#room_select').empty();
                $.each(response, function(index, room){
                    $('#room_select').append('<option value="' + room.id + '">Floor ' + room.floor + ', ' + room.room_name + '</option>');
                });
            }
        });
    });
</script>


