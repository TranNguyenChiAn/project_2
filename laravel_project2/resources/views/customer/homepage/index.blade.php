@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<title>Homepage</title>
<section>
    <img src="{{ asset('./images/banner_doctor.webp') }}" width="100%">
</section>
<section class="pt-0 pt-sm-5">
    <div class="container">
        <!-- Title -->
        <div class="row mb-4 mb-sm-5">
            <div class="col-12 text-center">
                <h2 class="mb-0">Doctor List</h2>
                <p class="mb-0">Book your doctor with us.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Card item -->
            @foreach($doctors as $doctor)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow h-100">
                    <div class="position-relative">
                        <!-- Image -->
                        <img src="{{asset('./images/' . $doctor->image)}}"
                             class="card-img-top object-fit-cover top-0" alt="Card image">
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
                    <div class="card-body">
                        <!-- Title -->
                        <h5 class="card-title me-2">
                            {{ $doctor -> name}}
                        </h5>

                        <!-- Address and Contact -->
                        <ul class="list-group list-group-borderless mb-0">
                            <li class="list-group-item small pb-0">
                                <i class="bi bi-pin-map-fill fa-fw h6 small mb-0">

                                </i> Specialization: {{ $doctor -> specialization -> name}}
                            </li>
                            <li class="list-group-item small pb-0">
                                <i class="bi bi-telephone-fill fa-fw h6 small mb-0">

                                </i> {{ $doctor -> contact_number}}
                            </li>
                        </ul>
                    </div>
                    <!-- Card body END -->

                    <!-- Card footer START-->
                    <div class="card-footer border-top">
                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="directory-detail.html" class="btn btn-link p-0 mb-0">View detail
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            <a href="#" class="h6 mb-0 z-index-2">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
