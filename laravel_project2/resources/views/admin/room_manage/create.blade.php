@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')
<title> Create room</title>
<section class=" position-absolute start-50 translate-middle-x">
    <h1 align="center" style="font-weight: bold; margin-top: 30px;color: #2f2ffe;"> Add a room</h1>
    <br>
    <div class="row g-6 bg-white">
        <form class="row bg-white" method="post" action="{{ route('room.store') }}"
              style="padding: 10px 24px"
              enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Floor</label>
                <input class="form-control" type="text" name="floor" placeholder="Floor number">
            </div>
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="room_name" placeholder="Room name">
            </div>
            <br>
            <div>
                <button class="btn btn-primary">Add room</button>
            </div>

        </form>
    </div>

</section>

