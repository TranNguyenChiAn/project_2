@vite(["resources/sass/app.scss", "resources/js/app.js"])

<header class="d-flex justify-content-around align-items-center py-3 px-0" style="background-color: #ffffff;font-family: Inter; font-weight: bold">
    <div class="float-start">
        <img src="{{asset('./images/daolua.png')}}" alt="brand" height="50px" class="rounded">
    </div>
    <div>
        <ul class="nav">
            <li class="nav-item d-flex">
                <a class="nav-link link-dark px-0" href="{{ route('index') }}"> PRODUCT </a>
                <button class="nav-link link-dark dropdown-toggle p-2" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"></button>
                @php
                    $specializations = \App\Models\Specialization::all();@endphp
                <ul class="dropdown-menu">
                    @foreach($specializations  as $specialization)
                        <li class="dropdown-item">
                            <a class="nav-link link-dark" href=" {{route('filter', $specialization->id)}}"> {{$specialization->name}} </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('showForm')}}" class="nav-link link-dark">
                    APPOINTMENT
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark">
                    CONTACT
                </a>
            </li>
            <li class="nav-item">
                <a href="#"
                   class="nav-link text-black">
                    ABOUT US
                </a>
            </li>
        </ul>
    </div>
    <!-- Profile dropdown START -->
    <div class="ms-3 dropdown float-end">
        <!-- Avatar -->
        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="avatar-img rounded-2" src="{{ asset('./images/coldmeow.png') }}"
                 alt="avatar" height="50px">
        </a>
        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
            <!-- Profile info -->
            <li class="px-3 mb-3">
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <div class="avatar me-3">
                        <img class="avatar-img rounded-circle shadow" src="{{ asset('./images/coldmeow.png') }}"
                             alt="avatar" height="50px">
                    </div>
                    <div>
                        <a class="h6 mt-2 mt-sm-0" href="#">Lori Ferguson</a>
                        <p class="small m-0">example@gmail.com</p>
                    </div>
                </div>
            </li>
            <!-- Links -->
            <li> <hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark-check fa-fw me-2"></i>My Bookings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-heart fa-fw me-2"></i>My Wishlist</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help Center</a></li>
            <li><a class="dropdown-item bg-danger-soft-hover" href="#"><i class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>
        </ul>
    </div>
</header>
