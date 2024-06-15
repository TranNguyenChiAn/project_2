@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
</head>
<body>
<section class="d-flex flex-column align-items-center">
    <div class="card mt-3 shadow-sm rounded-0 bg-white border-0 mb-3" style="width: 80%">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <img class="rounded-circle" height="180px" width="180px"
                         src="{{ asset('./images/'. $doctors->image)}}"
                         style="object-fit: cover; object-position: top" alt="doctor_portrait">
                </div>
                <div class="col-6 mt-3">
                    <b>Name:</b> {{$doctors -> name }}<br>
                    <b>Department:</b> {{$doctors -> department-> name }}<br>
                    <b>Email:</b> {{$doctors -> email}}<br>
                    <b>Time:</b>
                    @foreach($shift_details as $shift_detail)
                        <span class="text-muted mb-0 px-1">{{$shift_detail -> shift -> start_time}} - {{$shift_detail -> shift-> end_time}} |</span>
                    @endforeach
                </div>
                <div class="col-2">
                    <h4 class="text-success" style="font-weight: bold"> 150.000 VND</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <form class="row d-flex" style="margin-left: 60px;width: 90%; " id="datetime_form">
            @csrf
            @method('post')
            @foreach($dates as $date)
                <div class="col-6 card shadow-sm bg-white border-0 rounded-0 mt-3">
                    <div class="card-title mt-3">
                        <h3><b>{{ $date }}</b></h3>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            @foreach($availableTime as $time => $displayTime)
                                <div class="px-3 rounded-3 m-1" type="button" style="background-color: #7bd6ec">
                                    <input type="hidden" value="{{$date}}" name="date">
                                    <input type="hidden" value="{{$doctors->id}}" name="doctor_id">
                                    <input class="form-check-input" type="radio" value="{{ $displayTime }}"
                                           name="appointment_time">
                                    {{ $displayTime }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
</section>

<div class="container mt-5">
    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="formModalLabel">Appointment form</h5>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('appointment.storeForm')}}" id="info_form">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <span><b>Date:</b></span>
                            <span id="display_date"></span><br>
                            <span><b>Time: </b></span>
                            <span id="display_time"></span>
                            <input type="hidden" name="appointment_time" id="appointment_time">
                            <input type="hidden" name="date" id="appointment_date">
                            <input type="hidden" name="doctor_id" id="doctor_id">
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Full name" required value="{{session('customer.name')}}">
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" name="phone_number" class="form-control"
                                   placeholder="Phone number" required value="{{ $customer->phone }}">
                        </div>
                        <div class="form-group mt-3">
                            <label class=" align-content-center">Gender: </label>
                            <input class="form-check-input" type="radio" name="gender_id" value="1" required checked> Male
                            <input class="form-check-input" type="radio" name="gender_id" value="2"> Female
                        </div>
                        <div class="form-group mt-3">
                            @php
                                $td = strtotime("today");
                                $maxToday = date("d-m-y", $td);
                            @endphp
                            <label>Date birth</label>
                            <input type="date" name="date_birth" max="{{$maxToday}}" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="insurance_number" placeholder="Insurance number" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="customer_notes" placeholder="Note" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datetime_form .form-check-input').on('change', function() {
            // Lấy giá trị ngày và doctor_id từ form datetime_form
            let date = $(this).closest('div').find('input[name="date"]').val();
            let doctor_id = $(this).closest('div').find('input[name="doctor_id"]').val();
            let appointment_time = $(this).val();

            // Hiển thị giá trị ngày và thời gian dưới dạng văn bản
            $('#display_date').text(date);
            $('#display_time').text(appointment_time);

            $('#appointment_date').val(date);
            $('#appointment_time').val(appointment_time);
            $('#doctor_id').val(doctor_id);

            $('#formModal').modal('show');
        });
    });
</script>
</body>
</html>
@include('customer.layout.footer')