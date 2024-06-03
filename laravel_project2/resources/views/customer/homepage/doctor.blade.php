@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<title> Doctors </title>
    <div class="container">
    <!-- Title -->
        <div class="d-flex justify-content-between mb-4 mt-3 w-100">
            <div>
                <h2 style="font-family: Inter; font-weight: bold"> Choose Your Doctor</h2>
            </div>
            <div>
                <form class="d-flex" action="{{route('filter')}}" method="post">
                    @csrf
                    @method('post')
                    <select class="form-select select2-dropdown"  id="departmentSelect" name="department_id"
                            onChange="fetchDoctorsByDepartment(this.value)">
                        <option class="form-control" disabled> -- Choose -- </option>
                        @foreach($departments  as $department)
                            <option value="{{$department->id}}" name="department_id">
                                {{$department->name}}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary mx-2" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @php
        $colors = ['#FFD6EF', '#FEC091', '#A0E1E1', '#FFEB68','#9EE670FF']; // Mảng các màu
        $colorIndex = 0; // Biến đếm màu
    @endphp

    <div class="row g-3 p-lg-3" style="font-family: Inter; width:100%">
        <!-- Card item -->
        @foreach($doctors as $doctor)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card border-0 h-100">
                    <!-- IMAGE -->
                    <div class="position-relative bg-white rounded-4">
                        <!-- Image -->
                        <img src="{{asset('./images/' . $doctor->image)}}"
                             class="card-img-top object-fit-cover top-0 rounded-4" alt="Card image"
                             style="height: 380px; overflow: hidden; position: relative">
                        <!-- Overlay -->
                        <div class="card-img-overlay p-3 z-index-1">
                            @if($doctor -> gender -> id == 1)
                                <div class="badge text-bg-primary">
                                    <i class="fa-solid fa-building-columns bg-primary
                                            fa-fw text-warning"></i> Male
                                </div>
                            @elseif($doctor -> gender -> id == 2)
                                <div class="badge text-bg-danger">
                                    <i class="fa-solid fa-building-columns
                                        fa-fw text-warning"></i> Female
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card body START -->
                    <div class="card-body rounded-4 position-absolute bottom-0"
                         style="background-color: {{ $colors[$colorIndex % count($colors)] }};
                             width: 93%; margin-bottom: 9px; margin-left: 9px">
                        <div align="center">
                            <h5>
                                <b>{{ $doctor -> name}} </b>
                            </h5>
                            <p> {{ $doctor -> department-> name}} </p>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn bg-black rounded-5 px-lg-5">
                                <a href="{{route('doctor_detail', $doctor)}}" class="nav-link p-0 text-white"
                                   style="font-size: 12px">
                                    Make appointment
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $colorIndex++; // Tăng biến đếm chỉ mục màu lên để chuyển sang màu tiếp theo
            @endphp
        @endforeach
    </div>
<br>
<div class="d-flex justify-content-center">
    {{$doctors -> links()}}
</div>

@include('customer.layout.footer')
