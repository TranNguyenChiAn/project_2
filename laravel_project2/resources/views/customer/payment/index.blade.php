@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<title>Payment</title>

<div class="row g-3 w-100 d-flex justify-content-around mt-3">
    <div class="col-5">
        <div class="card">
            <div class="card-body bg-white">
                <p>ID: {{$appointments->id}}</p>
                <p>Customer name: {{$appointments->customer_name}}</p>
                <p>Phone: {{$appointments->phone}}</p>
                <p>Insurance number: {{$appointments->insurance_number}}</p>
                <p>Date of birth: {{$appointments->date_birth}}</p>
                <p>Gender: {{$appointments-> gender -> name}}</p>

                <p>Doctor: {{$appointments->doctor->name}} - {{$appointments->doctor->department->name}}</p>
                <p>Date: {{$appointments->date}}</p>
                <p>Time: {{$appointments->time}}</p>
                <p>Note: {{$appointments->note}}</p>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div>
            <h4 class="d-flex justify-content-center"> Payment Method </h4>
               <button type="submit" name="payment_method" style="border-radius: 0; width:100%" class="btn btn-warning px-4" value="2">
                   Banking
               </button>
               <button type="submit" name="payment_method" style="background-color: #f3209f" class="payment_button" value="3">
                   Pay with Momo
               </button>
            <form class="d-block" id="paymentForm" method="POST" action="{{ route('vnpay.payment',$appointments )}}" enctype="application/x-www-form-urlencoded">
                @csrf
                @method('post')
                <input type="hidden" name="appointment_id" value="{{ $appointments->id }}">
                <button type="submit" name="redirect" style="border-radius: 0; width:100%" class="btn btn-primary px-4" value="4">
                    Pay with VnPay
                </button>
            </form>
        </div>
        <br>
    </div>
</div>


