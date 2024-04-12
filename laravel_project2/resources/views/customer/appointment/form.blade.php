@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer/layout/nav')

<section style="font-family: Inter;margin-right: 30px; padding: 18px">
    <h2 align="center" style="font-weight: bold;color: #2f2ffe; margin-top: 30px">
        Patient's Information
    </h2>
    <div class="wrapper d-flex align-items-stretch justify-content-center">
        <div class="" style="width: 720px">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3>Patient Form
                                <a href="{{route('index')}}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('storeForm')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                                aria-controls="home-tab-pane" aria-selected="true">
                                            Patient
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="detail-tab" data-bs-toggle="tab"
                                                data-bs-target="#detail-tab-pane" type="button" role="tab"
                                                aria-controls="detail-tab-pane" aria-selected="false">
                                            Appointment
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            @php
                                                $td = strtotime("today");
                                                $maxToday = date("Y-m-d", $td);
                                            @endphp
                                            <label class="fs-4">Date birth</label>
                                            <input type="date" name="date_birth" max="{{$maxToday}}" class="form-control" required>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Gender</label>
                                            @foreach($genders as $gender)
                                                <input class="form-check-input" checked type="radio" name="gender_id"
                                                       value="{{ $gender -> id}}" required> {{ $gender -> name}}
                                            @endforeach
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Address</label>
                                            <input class="form-control" checked type="text" name="address" required>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Insurance number</label>
                                            <input type="text" name="insurance_number" class="form-control">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Phone number</label>
                                            <input type="text" name="phone_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab" tabindex="0">
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Doctor</label>
                                            <option disabled selected> -- Choose doctor --</option>
                                            <select name="doctor_id" class="form-control" required>
                                                @foreach($doctors as $doctor)
                                                    <option name="doctor_id" value="{{$doctor->id}}">{{$doctor->name}} - Khoa {{$doctor->specialization->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            @php
                                                $td = strtotime("today");
                                                $minToday = date("Y-m-d", $td);
                                            @endphp
                                            <label class="fs-4">Date time</label>
                                            <input name="date_time" min="{{ $minToday }}" type="datetime-local" class="form-control" required>

                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Note</label>
                                            <input type="text" name="note" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

