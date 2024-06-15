@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<title>Payment</title>

<div class="row g-3 w-100 d-flex justify-content-around mt-3">
    <div class="col-6">
        <div class="card bg-white">
            <div class="card-body">
                    <div class="modal-header d-flex justify-content-between">
                        <h6 class="modal-title" id="formModalLabel">
                            <b>Appointment ID: </b> #{{ $appointment -> id }}
                        </h6>
                    </div>
                    <div class="modal-body">
                        <p class="m-2"> <b>Personal information</b></p>
                        <div class="card bg-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-start">
                                    <i class="bi bi-person-circle fs-1"></i>
                                    <div class="mx-lg-2">
                                        <b>{{ $appointment-> customer_name }}</b>
                                        <div class="d-flex justify-content-between  text-secondary">
                                            <i class="bi bi-telephone">
                                                {{ $appointment-> phone }}
                                            </i>
                                            <i class="bi bi-envelope mx-lg-5">
                                                {{ session('customer.email') }}
                                            </i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-2 m-0">
                                    <div class="card-body m-0 p-2 rounded-3" style="background-color: #f4f5f8">
                                        My notes: <p class="m-0"><b>{{ $appointment -> customer_notes}}</b></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span><b>Insurance number: <br>{{ $appointment-> insurance_number }} </b></span>
                                    <div class="mx-lg-5">
                                        <i class="bi bi-cake2">
                                            <b>{{ $appointment-> date_birth }}</b>
                                        </i><br>

                                        <i class="bi bi-gender-ambiguous">
                                            <b>{{ $appointment-> gender->name }}</b>
                                        </i>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <p class="mt-3 m-2"> <b>Appointment information</b></p>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p>
                                        <b>Doctor: </b><br>
                                        {{ $appointment-> doctor->name }} - {{ $appointment-> doctor-> department -> name}}
                                    </p>
                                    <p> <b>Room: </b><br>
                                    {{$appointment-> doctor -> room -> room_name}}
                                    <p><b>Date: </b> <br>
                                        {{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('l, jS F Y') }},
                                        {{ \Carbon\Carbon::parse($appointment->time)->format('H:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div>
            <h4 class="d-flex justify-content-center"><b> Payment Method </b></h4>
               <button type="submit" name="payment_method" style="width:100%" class="btn btn-warning px-4" value="2">
                   Banking
               </button>
               <button type="submit" name="payment_method" style="background-color: #f3209f; width:100%"
                       class="btn btn-warning px-4 mt-2 text-white" value="3">
                   Pay with Momo
               </button>
            <form class="d-block" id="paymentForm" method="POST" action="{{ route('vnpay.payment',$appointment )}}" enctype="application/x-www-form-urlencoded">
                @csrf
                @method('post')
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <button type="submit" name="redirect" style="width:100%" class="btn btn-primary px-4 mt-2" value="4">
                    Pay with VnPay
                </button>
            </form>
        </div>

        <p class="text-danger" style="font-weight: bold; font-style: italic">
            Please pay at the latest 1 day before your medical examination
        </p>
        <button style="width:100%" class="btn btn-outline-secondary px-4 mt-2">
            <a href="/customer/index" class="text-decoration-none text-dark" >
                Pay later
            </a>
        </button>
        <br>
    </div>
</div>


