@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

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

<section class="position-absolute start-50 translate-middle-x" style="font-size: 18px">
    <h1 align="center" style="font-weight: bold; color: #2f2ffe; margin-top: 30px"> EDIT DOCTOR </h1>
    <br>
    <div class="row g-3 bg-white">
        <form class="row g-3 bg-white" method="post" action="{{ route('doctor.update', $doctor)}}"
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
                <select class="form-select" type="text" name="specialization" >
                    @foreach($specialization as $specialization)
                        <option class="form-control" value="{{ $specialization->id }}"
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
                <input class="form-control" type="text" name="address" value="{{ $doctor->address }}"><br>
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
                <label class="form-label"> Image:</label>
                <input type="file" name="image" id="imageFile" accept="image/*" onchange="chooseFile(this)">
                <div id="image" height="150px">
                    <img style="object-fit: cover; width: 150px; height: 150px"
                         src="{{ asset('./images/' . $doctor->image) }}"
                    >
                </div>
            </div>

            <br>
            <div class="w-75 d-flex justify-content-end">
                <button class="btn btn-primary col-2" type="submit">Update</button>
            </div>
        </form>
    </div>
</section>


