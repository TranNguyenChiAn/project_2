@vite(["resources/sass/app.scss", "resources/js/app.js"])

<header class="header bg-dark">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-dark navbar-expand-xl">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="index.html">
                <img class="navbar-brand-item rounded-circle" src="{{ asset('./images/Fu_Xuan.webp') }}"
                     alt="logo" style="height:50px">
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto me-3 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
            </button>

            <!-- Main navbar START -->
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll mx-auto">

                    <!-- Nav item Listing -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="listingMenu"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Doctors
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="listingMenu">
                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Hotel</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="index.html">Hotel Home</a></li>
                                    <li> <a class="dropdown-item" href="index-hotel-chain.html">Hotel Chain</a></li>
                                    <li> <a class="dropdown-item" href="index-resort.html">Hotel Resort</a></li>
                                    <li> <a class="dropdown-item" href="hotel-grid.html">Hotel Grid</a></li>
                                    <li> <a class="dropdown-item" href="hotel-list.html">Hotel List</a></li>
                                    <li> <a class="dropdown-item" href="hotel-detail.html">Hotel Detail</a></li>
                                    <li> <a class="dropdown-item" href="room-detail.html">Room Detail</a></li>
                                    <li> <a class="dropdown-item" href="hotel-booking.html">Hotel Booking</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Specialization</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="index-flight.html">Flight Home</a></li>
                                    <li> <a class="dropdown-item" href="flight-list.html">Flight List</a></li>
                                    <li> <a class="dropdown-item" href="flight-detail.html">Flight Detail</a></li>
                                    <li> <a class="dropdown-item" href="flight-booking.html">Flight Booking</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Tour</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="index-tour.html">Tour Home</a></li>
                                    <li> <a class="dropdown-item" href="tour-grid.html">Tour Grid</a></li>
                                    <li> <a class="dropdown-item" href="tour-detail.html">Tour Detail</a></li>
                                    <li> <a class="dropdown-item" href="tour-booking.html">Tour Booking</a></li>
                                </ul>
                            </li>

                            <!-- Dropdown submenu -->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Cab</a>
                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="index-cab.html">Cab Home</a></li>
                                    <li> <a class="dropdown-item" href="cab-list.html">Cab List</a></li>
                                    <li> <a class="dropdown-item" href="cab-detail.html">Cab Detail</a></li>
                                    <li> <a class="dropdown-item" href="cab-booking.html">Cab Booking</a></li>
                                </ul>
                            </li>

                            <li> <a class="dropdown-item" href="booking-confirm.html">Booking Confirmed</a></li>
                            <li> <a class="dropdown-item" href="compare-listing.html">Compare Listing</a></li>
                            <li> <a class="dropdown-item" href="offer-detail.html">Offer Detail</a></li>
                        </ul>
                    </li>

                    <!-- Nav item Pages -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.appointment') }}">
                            Appointment
                        </a>
                    </li>

                    <!-- Nav item Link -->
                    <li class="nav-item"> <a class="nav-link" href="#">Contact us</a> </li>

                    <!-- Nav item Link -->
                    <li class="nav-item"> <a class="nav-link" href="#">About us</a> </li>
                </ul>
            </div>
            <!-- Main navbar END -->

            <!-- Profile and Notification START -->
            <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto">

                <!-- Profile dropdown START -->
                <li class="nav-item ms-3 dropdown">
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
                </li>
                <!-- Profile dropdown END -->
            </ul>
            <!-- Profile and Notification START -->
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
