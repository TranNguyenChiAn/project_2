@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer/layout/nav')

<section style="font-family: Inter;margin-right: 30px; padding: 18px">
    <h2 align="center" style="font-weight: bold;color: #2f2ffe; margin-top: 9px">
        Customer's Information
    </h2>
    <div class="wrapper d-flex align-items-stretch justify-content-center">
        <div class="" style="width: 720px">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <form action="{{route('appointment.storeForm')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                                aria-controls="home-tab-pane" aria-selected="true">
                                            Customer
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
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            @php
                                                $td = strtotime("today");
                                                $maxToday = date("Y-m-d", $td);
                                            @endphp
                                            <label>Date birth</label>
                                            <input type="date" name="date_birth" max="{{$maxToday}}" class="form-control" required>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class=" align-content-center">Gender: </label>
                                            @foreach($genders as $gender)
                                                <input class="form-check-input" checked type="radio" name="gender_id"
                                                       value="{{ $gender -> id}}" required> {{ $gender -> name}}
                                            @endforeach
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label>Insurance number</label>
                                            <input type="text" name="insurance_number" class="form-control">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label>Phone number</label>
                                            <input type="text" name="phone_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="detail-tab-pane" role="tabpanel"
                                         aria-labelledby="detail-tab" tabindex="0">
                                        <div class="row">
                                            <div class="mb-3 mt-3">
                                                <input type="hidden" value="{{$doctors->id}}" name="doctor_id">
                                                <label>Doctor: {{$doctors-> name}} - {{$doctors-> specialization -> name}}</label>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                @php
                                                    $td = strtotime("today");
                                                    $minToday = date("Y-m-d", $td);
                                                @endphp
                                                <label>Date</label>
                                                <input name="date" min="{{ $minToday }}" type="date" class="form-control" required>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label>Time</label>
                                                <select name="appointment_time" id="appointment_time" class="form-control" required>
                                                    @foreach($availableTime as $time => $displayTime)
                                                        <option value="{{ $displayTime }}">{{ $displayTime }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="mb-3 mt-3">
                                                    <label>Note</label>
                                                    <input type="text" name="note" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <button id="submit_button" type="submit" class="btn btn-primary">Submit</button>
                                    <div id="error-message" style="color: red;"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $('.mb-3').on('input', function() {
            let allFieldsFilled = true;

            $('.mb-3').each(function() {
                if ($(this).val().trim() === '') {
                    allFieldsFilled = false;
                    return false; // Dừng vòng lặp nếu một trường rỗng được tìm thấy
                }
            });

            if (allFieldsFilled) {
                $('#submit_button').prop('disabled', false);
                $('#error-message').text('');
            } else {
                $('#submit_button').prop('disabled', true);
                $('#error-message').text('Please fill in all required fields');
            }
        });
    });
</script>
