@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section class="pt-0 pt-sm-5">
<div class="wrapper">
    <div>
        <button class="btn btn-primary">
            <a class="nav-link" href="{{route('appointment.specialization_list')}}">
                Choose by specializations
            </a>
        </button>
        <button class="btn btn-primary">
            <a class="nav-link" href="{{route("appointment.doctor_list")}}">
                Choose by doctors
            </a>
        </button>
    </div>
</div>
</section>






