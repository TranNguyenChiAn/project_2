@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('customer.layout.nav')
        <!DOCTYPE html>
<html lang="en">
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        width: 1500px;
        text-align: center;
        overflow: auto;
        background-color: #bcddefe7;
    }



    /* PHAN HEAD */
    #head {
        width: 1500px;
        height: 100px;
        margin-top: 50px;
        border-radius: 5px;
        border: 2px solid #dcf1ee;
        display: flex;
        justify-content:space-around;
        background-color: white;
        text-decoration: none;
        color: #000;
    }

    a {
        text-decoration: none;
        justify-content: baseline;
        color: #000;
        font: 20px sans-serif;
    }

    #head a:hover {
        color: #3a926f;
        /* box-shadow: 10px 10px 5px 5px #888888; */
    }


    /* DANH MUC LUC */
    .menu_name {
        color: #000;
        background-color: #ffff;
        margin-top: 5px;
        margin-left: 20px;
        /* font-weight: 550; */
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #000000;
        background-color: #ffff;
    }


    /* NUT USER */
    .btnuser {
        border: none;
        border-radius: 30px;
        margin-left: 50px;
        background-color: #e9f9ff;
    }

    .btnuser i {
        color: #69ddd5;
        margin-top: 20px;
    }

    .btnuser i:hover {
        color: #265451;
    }



    /* Muc anh queo com */
    .welcome {
        width: 1297px;
        height: 600px;
        text-align: left;
        background-image: url({{ asset('./images/welcome.png')}});
    }

    .introduce {
        position: absolute;
        margin-top: 150px;
        margin-left: 50px;
    }

    .introduce h3 {
        color:#346764 ;
        font-family: 'Times New Roman', Times, serif;
        margin-left: 30px;
        margin-bottom: 50px;
    }

    .introduce h1 {
        color: #265451;
        margin-top: 20px;
    }



    /* Phan chem gio ve benh vien */
    .about1_n {
        width: 1519px;
        height: 690px;
        background-color: #344067;
    }
    .about1 {
        display: flex;
        justify-content: space-around;
        text-align: left;
        background-color: #344067;
        /* background-image: url(img/whychooseme.png); */
        background-repeat: no-repeat;

    }


    .about1 h1 {
        width: 320px;
        margin-top: 130px;
        color: #BDE9F9;
        font: 48px sans-serif;
    }

    .about1 h5 {
        width: 520px;
        margin-top: 160px;
        color: #D3FCFA;
        font: 24px sans-serif;
        font-family: 'Times New Roman', Times, serif;
    }

    .ctn2 {
        justify-content: space-around;
    }

    .ctn2 img {
        max-width: 500px;
        height: 300px;
        margin-top: 80px;
    }

    /* CTN 3 */

    .ctn3 {
        /* background-image: url(img/ctn3.png); */
        background-image: linear-gradient(to right, #c3e0f8, #f4f8ff);
        background-repeat: no-repeat;
        background-origin: border-box;
        width: 1518px;
        height: 700px;
        display: flex;
    }

    .ctn3_1 {
        width: 600px;
        height: auto;
        margin-top: 70px;
        margin-left: 100px;
        color: #265451;
        font:  sans-serif;
        font-weight:800;
    }

    .ctn3_1 img{
        max-width: 450px;
        max-height: fit-content;
        margin-top: 60px;
        border-radius: 20px;
        border: 2px solid #ffffff;
    }

    .ctn3_2 {
        width: 600px;
        height: auto;
        margin-top: 70px;
        font-family: 'Times New Roman', Times, serif;
    }

    .ctn3_2 p {
        font-size: 26px;
        text-align: left;
        color: #4A837F;
        margin-bottom: 60px;
    }

    /* CTN 4 */
    .ctn4 {
        width: 1518px;
        height: 700px;
        background-color: #263554;
        color: #ffffff;
        overflow: auto;
    }

    .ctn4 h1 {
        margin-top: 60px;
        margin-bottom: 20px;
    }

    .ctn4 h5 {
        margin-bottom: 60px;
    }

    .ctn4_1 {
        display: flex;
        justify-content: center;
    }

    .ctn4_1 p {
        width: 250px;
        height: 300px;
        margin: 20px;
        color: #000;
        font-size: 24px;
        justify-content: space-around;
        text-align: center;
        border-radius: 20px;
        background-color: #b0cfd9;
    }

    .ctn4 button {
        margin-top: 50px;
        width: 300px;
        height: 50px;
        font-size: 25px;
        color: #ffffff;
        background-color: #2c5662;
        border-radius: 7px;
        border: 2px solid #ffffff;
    }

    .ctn4 button:hover {
        background-color: #a2cecbd9;
    }

</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/da5959092f.js"
            crossorigin="anonymous"></script>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">
    <link rel="stylesheet" href="css/slideshow.css">
    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <title>About us</title>
</head>
<body>
<div class="container">
    <div class="welcome">
        <div class="introduce">
            <h3>Welcome to Fraud Hospital</h3>
            <h1>Treatment with heart and mind</h1>
            <h1>Caring with science and love</h1>
        </div>

    </div>
</div>

<div data-bs-spy="scroll" data-bs-target="#navbar-example2"
     data-bs-offset="0" class="scrollspy-example" tabindex="0">
    <div class="scrollspyHeading1">
        <a href="index.html"></a>
    </div>

    <div id="scrollspyHeading2">
        <div class="about1_n">
            <div class="about1">
                <h1>Entrust your health to us for protection</h1>
                <h5>Here we have a team of professional, skilled doctors and modern,
                    complete facilities. We ensure to always be dedicated, responsible,
                    and attentive to customers.</h5>
            </div>
            <div class="ctn2">
                <img src="img/1.webp" alt="">
                <img src="img/2.jpg" alt="">
                <img src="img/3.jpg" alt="">
            </div>
        </div>
    </div>

    <div class="ctn3">
        <div class="ctn3_1">
            <h2>PERIODIC OVERALL HEALTH EXAMINATION PROGRAM</h2>
            <img src="img/about.webp" alt="">
        </div>
        <div class="ctn3_2">
            <p>Regular health checks can help detect diseases early while they are
                still at a manageable stage or can even improve the progression of the
                disease. Good health is the most important thing that determines the
                quality of life and therefore, regular health check-ups should not be
                neglected. Detecting disease early makes a complete and important
                change, helping you monitor potential health risks so you can live a
                healthy life and avoid expensive treatment costs later. At Hanoi
                French Hospital, we provide comprehensive health check-up packages for
                both men and women suitable for all ages.</p>
            <h5>Choose health check-up at , enjoy life with peace of mind!</h5>
        </div>
    </div>

    <div class=" ctn4" id="scrollspyHeading5">
        <h1>
            PERIODIC HEALTH EXAMINATION
        </h1>
        <h5>TO PROTECT YOUR MOST VALUABLE ASSETS AND THAT OF YOUR LOVED ONES</h5>
        <div class="ctn4_1">
            <p>Early detection of body abnormalities.</p>
            <p>Control potential diseases such as blood fat, high blood pressure, osteoporosis, diabetes, thyroid...</p>
            <p>Intervene and treat promptly to avoid unpredictable complications.</p>
            <p>Save time and treatment costs.</p>
        </div>
        <a href="apointment.html" style="text-decoration: none;">
            <button>Take an Appointment</button>
        </a>
    </div>

    <div class="doctor" id="scrollspyHeading3"></div>
</div>

</body>
</html>
@include('customer.layout.footer')