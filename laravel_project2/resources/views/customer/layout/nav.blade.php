@vite(["resources/sass/app.scss", "resources/js/app.js"])

<style>
    .nav-link {
        color: #dcdcdc;
    }

    .nav-link:hover{
        color: #2f2ffe;
    }

    .link-custom {
        color: #bdbbbb;
        margin: 0.2rem;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .link-custom.active {
        color: #2f2ffe;
    }

</style>
<header class="d-flex justify-content-around align-items-center py-3 px-0" style="background-color: #ffffff; font-weight: bold">
    <div class="float-start">
        <img src="{{asset('./images/daolua.png')}}" alt="brand" height="50px" class="rounded">
    </div>
    <div>
        <ul class="nav align-items-center">
            <li class="nav-item">
                <a class="nav-link link-primary link-custom" id="homepage" href="{{ route('index') }}">
                    Homepage
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('findDoctor') }}" id="findDoctor" style="color: grey">
                    Find your Doctor
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-custom" id="contact" style="color: grey">
                    Contact
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-custom" id="about_us" style="color: grey">
                    About us
                </a>
            </li>
        </ul>
    </div>

    <!-- Profile dropdown START -->
    <div class="ms-3 dropdown float-end">
        <!-- Avatar -->
        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
           data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
           aria-expanded="false">
            <img class="avatar-img rounded-2" src="{{ asset('./images/coldmeow.png') }}"
                 alt="avatar" height="50px">
        </a>
        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
            aria-labelledby="profileDropdown">
            <!-- Profile info -->
            <li class="px-3 mb-3">
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <div class="avatar me-3">
                        <img class="avatar-img rounded-circle shadow" src="{{ asset('./images/coldmeow.png') }}"
                             alt="avatar" height="50px">
                    </div>
                    <div>
                        <a class="h6 mt-2 mt-sm-0" href="#">{{session('customer.name')}}</a>
                        <p class="small m-0">{{session('customer.email')}}</p>
                    </div>
                </div>
            </li>
            <!-- Links -->
            <li> <hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("appointment.list")}}"><i class="bi bi-bookmark-check fa-fw me-2"></i>My Bookings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help Center</a></li>
            <li><a class="dropdown-item bg-danger-soft-hover" href="{{route('customer.logout')}}"><i class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>
        </ul>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to set active class from localStorage
        function setActiveLink() {
            const activeLinkId = localStorage.getItem('activeLinkId');
            if (activeLinkId) {
                document.getElementById(activeLinkId).classList.add('active');
            }
        }

        // Set active class on page load
        setActiveLink();

        // Add click event listeners to all custom links
        document.querySelectorAll('.link-custom, .nav-link').forEach(link => {
            link.addEventListener('click', function(event) {
                // Remove 'active' class from all links
                document.querySelectorAll('.link-custom, .nav-link').forEach(l => {
                    l.classList.remove('active');
                });

                // Add 'active' class to the clicked link
                this.classList.add('active');

                // Store the active link's ID in localStorage
                localStorage.setItem('activeLinkId', this.id);
            });
        });
    });
</script>
