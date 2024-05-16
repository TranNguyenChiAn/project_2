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
<div class="d-flex flex-column flex-shrink-0 position-fixed"
     style="width: 246px;height: 100vh; position: absolute; background-color: white">
    <div class="d-flex mt-lg-4 mx-3">
        <i class="bi bi-emoji-laughing-fill fs-1 mx-3"></i>
        <div>
            <p class="p-0 m-0">
                <b>{{session('admin.name')}}</b>
            </p>
            <p style="color: #b7b6b6; font-size: 12px"> Dashboard</p>
        </div>
    </div>
    <ul class="nav flex-column mt-4 align-content-center"
        style="font-weight: bold; font-size: 16px">
        <li>
            <a href="{{ route('static.index')}}" id="dashboard_link" class="nav-link link-custom">
                <i class="bi bi-pie-chart-fill"></i>
                Statistic
            </a>
        </li>
        <li>
            <a href="{{ route('appointment.showData') }}" id="schedule_link"  class="nav-link link-custom">
                <i class="bi bi-calendar-fill"></i>
                Schedule
            </a>
        </li>
        <li>
            <a href="{{ route('admin.doctor') }}" id="doctor_link"  class="nav-link link-custom">
                <i class="bi bi-person-fill"></i>
                Doctors
            </a>
        </li>
        <li>
            <a href="{{ route('specialization.index') }}" id="specialization_link"  class="nav-link link-custom">
                <i class="bi bi-list"></i>
                Specialization
            </a>
        </li>
        <li>
            <a href="{{ route('appointment.index') }}" id="appointment_link"  class="nav-link link-custom">
                <i class="bi bi-journal"></i>
                Appointments
            </a>
        </li>
        <li>
            <a href="{{ route('customer.index')}}" id="customer_link"  class="nav-link link-custom">
                <i class="bi bi-person-vcard-fill"></i>
                Customers
            </a>
        </li>
        <li>
            <a href="{{ route('shift.index')}}" id="shift_link"  class="nav-link link-custom">
                <i class="bi bi-clock-fill"></i>
                Shifts
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" class="nav-link link-custom">
                <i class="bi bi-power"></i>
                Logout
            </a>
        </li>
    </ul>
</div>
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


