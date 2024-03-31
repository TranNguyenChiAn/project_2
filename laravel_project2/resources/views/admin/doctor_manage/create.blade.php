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
    <h1 align="center" style="font-weight: bold;color: #2f2ffe; margin-top: 30px"> Add a doctor </h1>
    <br>
    <div class="row g-6 bg-white">
        <form class="row g-3 bg-white" method="post" action="{{ route('doctor.store') }}"
              style="padding: 10px 24px"
              enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name">
                @if($errors->has('name'))
                    {{ $errors->first('name') }}
                @endif<br>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email </label>
                <input class="form-control" placeholder="Email" type="email" name="email">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif<br>
            </div>
            <div class="col-md-12">
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
                <label class="form-label">Specialization</label>
                <select class="form-select dropdown" required name="specialization_id">
                    <option> --Choose-- </option>
                    @foreach($specialization as $specialization)
                        <option value="{{ $specialization -> id}}"> {{ $specialization -> name}} </option>
                    @endforeach
                </select>

            </div>
            <div class="col-md-6">
                <label class="form-label">Contact number</label>
                <input class="form-control" type="phone" name="contact_number" placeholder="Contact number">
            </div>
            <br>
            <div class="col-md-6">
                <label class="form-label"> Address </label>
                <input class="form-control" type="address" name="address" placeholder="Address">
            </div>
            <div class="col-md-6">
                <br>
                <label class="form-label"> Image:</label>
                <input type="file" name="image" id="imageFile" accept="image/*" onchange="chooseFile(this)">
                <style>
                    #image img {
                        height: 200px;
                    }
                </style>
                <img id="image" style="object-fit: cover; width: 150px; height: 150px">
            </div>


            <button class="btn btn-primary" style="margin-top: 24px">Add</button>
        </form>
    </div>

</section>
