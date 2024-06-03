@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')

<!DOCTYPE html>
<html lang="en">
<style>
    .trai {
        width: 600px;
        height: auto;
    }

    .trai h2 {
        font-weight: bolder;
        margin-top: 50px;
        font-size: 50px;
        margin-left: 40px;
        color: rgb(58, 56, 56);
    }

    .btn_chixem button {
        width: 400px;
        height: 50px;
        margin-left: 50px;
        margin-top: 20px;
        text-align: left;
        display: flex;
        line-height: 50px;
        border-radius: 10px;
        border: 1px solid #c1c1c1;
        background-color: #fff;
    }

    .btn_chixem button:hover {
        background-color: rgb(58, 56, 56);
        border: rgb(58, 56, 56);
        color: #fff;
        margin-left: 55px;
        transition: 0.2s;
    }

    .input {
        width: 600px;
        margin-top: 18px;
        margin-left: 50px;
    }

    label {
        font-weight: bolder;
        font-size: 18px;
        color: rgb(58, 56, 56);
    }

    .btn_send {
        margin-top: 20px;
        background-color: rgb(58, 56, 56);
        color: #ffffff;
        border: none;
        font-size: 14px;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
</head>
<body>
    <div class="" style="display: flex;font-family: Inter;">
        <div class="trai" style="border-bottom: 1px solid rgb(167, 167, 167);">
            <div>
                <h2>Contact us</h2>
                <p style="color: rgb(106, 106, 106); margin-left: 40px; margin-bottom: 50px;">Any question? We would be happy to help you!</p>
                <form class="btn_chixem">
                    <button class="form-control align-items-center">
                        <i class="bi bi-telephone mx-3"></i>
                        <span>+84123456789</span>
                    </button>

                    <button class="form-control align-items-center">
                        <i class="bi bi-envelope mx-3"></i>
                        <span>fraudhospital@gmail.com</span>
                    </button>

                    <button class="form-control align-items-center">
                        <i class="bi bi-pin mx-3"></i>
                        <span>Chua Ba Danh</span>
                    </button>

                </form>

                <div class="d-flex w-50 justify-content-around mt-5">
                    <i class="bi bi-facebook fs-1">
                        <a href="#"></a>
                    </i>
                    <a>
                        <img src='{{ asset('./images/twitter.png')}}' width="37px">
                    </a>

                    <a>
                        <img src='{{ asset('./images/instagram.png')}}' width="37px">
                    </a>

                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center"
             style="border-left: 3px solid rgb(220,216,216)">
            <div class="input">
                <form class="row g-3">
                    <div class="col-md-6">
                      <label for="input" class="form-label">First Name</label>
                      <input type="text" class="form-control" placeholder="Your first name">
                    </div>
                    <div class="col-md-6">
                      <label for="input" class="form-label">Last Name:</label>
                      <input type="text" class="form-control" placeholder="Your last name">
                    </div>
                    <div class="col-12">
                      <label for="inputEmail4" class="form-label">Email:</label>
                      <input type="email" class="form-control" id="inputEmail4"  placeholder="youremail@gmail.com">
                    </div>
                    <div class="col-12">
                      <label for="input" class="form-label">Phone Number:</label>
                      <input type="tel" class="form-control" placeholder="Your phone number">
                    </div>
                    <div class="col-12">
                        <label for="input" class="form-label">Message:</label>
                        <textarea type="text"  style="height: 100px" class="form-control"
                        placeholder="Type your message here..."></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn_send w-100 p-2" type="submit">
                            Send Message
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>

@include('customer.layout.footer')
