@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<section style="font-family: Inter">
    <div class="row d-flex mt-4">
        <div class="col-lg-4">
            <div class="mb-4">
                <div class="text-center">
                    <img src="{{asset('./images/' . $doctors->image)}}" alt="avatar"
                         class="rounded-3" style="width: 240px;">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4 p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$doctors -> name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Specialization</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$doctors -> specialization -> name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Time:</p>
                        </div>
                        <div class="col-sm-9">
                            @foreach($shift_details as $shift_detail)
                                <p class="text-muted mb-0">{{$shift_detail -> shift -> start_time}} - {{$shift_detail -> shift-> end_time}}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$doctors -> email}}</p>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary mt-3">
                    <a class="text-white nav-link" href="{{ route('appointment.Form', $doctors -> id )}}">
                        Make an appointment</a>
                </button>
            </div>
        </div>
    </div>
</section>

