@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')
<head>
    <link rel="icon" href="{{asset('./images/logo_fraud.png')}}" type="image/png">
</head>

<title>Homepage</title>
<section>
    <img class="object-fit-cover px-3" src="{{ asset('./images/banner.png') }}" width="100%">
    <button class="fs-5 btn rounded-4 bg-white shadow-lg p-3 px-4" style=" position: relative;margin: -20% 0 0 8%">
        <a class="nav-link link-dark" href="{{route('findDoctor')}}">
            <b>Book An Appointment</b>
        </a>
    </button>
</section>
<section class="pt-sm-5">
    <div class="d-flex flex-column align-items-center" style="font-family: Inter">
        <h2><b>How It Works?</b></h2>
        <p class="m-0"> Discover, book and experience personalized healthcare effortlessly </p>
        <p class="m-0">with our user-friendly Doctor Appointment Website.</p>
        <div class="d-flex justify-content-center mt-3" >
            <table cellpadding="20px">
                <tr align="center" class=" fs-6">
                    <td>
                        <div class="d-flex align-items-center justify-content-center" >
                            <div class="d-flex">
                                <i class="bi bi-person-check p-3 rounded-3 bg-white shadow-lg"></i>
                                <i class="bi bi-1-circle-fill" style="color: blue; margin: -3px 0 0 -10px"></i>
                            </div>
                        </div>
                        <h4 class="mt-4"><b> Find A Doctor </b></h4>
                        <p class="m-0"> Discover skilled doctors based on </p>
                        <p class="mt-0"> specialization and location.</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center" >
                            <div class="d-flex">
                                <i class="bi bi-calendar3 p-3 rounded-3 bg-white shadow-lg"></i>
                                <i class="bi bi-2-circle-fill" style="color: blue; margin: -3px 0 0 -10px"></i>
                            </div>
                        </div>
                        <h4 class="mt-4"><b> Book Appointment </b></h4>
                        <p class="m-0"> Effortlessly book appointments at </p>
                        <p class="mt-0">your convenience.</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center" >
                            <div class="d-flex">
                                <i class="bi bi-bag-plus p-3 rounded-3 bg-white shadow-lg"></i>
                                <i class="bi bi-3-circle-fill" style="color: blue; margin: -3px 0 0 -10px"></i>
                            </div>
                        </div>
                        <h4 class="mt-4"><b> Get Service </b></h4>
                        <p class="m-0"> Receive personalized healthcare </p>
                        <p class="mt-0">services tailored to your needs. </p>
                    </td>
                </tr>
            </table>
            <div class="d-flex justify-content-around position-absolute w-50 mt-4" style="z-index: 3">
                <p>------------------</p>
                <p>------------------</p>
            </div>
        </div>
    </div>

</section>
<section class="px-5 pt-sm-5 bg-white">
    <div class="d-flex" style="font-family: Inter">
        <div>
            <img class="image rounded-4" src="{{asset('./images/img_doctor.jpeg')}}" height="480px">
        </div>
        <div class="m-5">
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non …</p>
            <div class="d-flex justify-content-around">
                <div>
                    <p style="font-size: 36px; color: #0a58ca; margin: 0"> 2000+</p>
                    <p> Satisfied Patients</p>
                </div>
                <div>
                    <p style="font-size: 36px; color: #0a58ca; margin: 0"> 50+</p>
                    <p> Specialized Medical Service</p>
                </div>
            </div>

            <div>
                <button class="btn bg-primary px-4">
                    <a class="nav-link text-white" href="{{route('findDoctor')}}">
                        <b>Book An Appointment</b>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <br>
<br>
</section>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2" defer></script>
<x-flash-message/>

@include('customer.layout.footer')