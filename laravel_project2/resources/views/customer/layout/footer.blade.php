@vite(["resources/sass/app.scss", "resources/js/app.js"])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        /* CSS cho footer */
        footer {
            padding: 20px;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
<!-- Nội dung footer -->
<footer class="bg-primary">
    <div class="row">
        <div class="col-6 align-content-start">
            <p>© 2024 Đặt lịch khám bệnh online. All rights reserved.</p>
            <p>Liên hệ: info@datlichkham.vn</p>
            <p>Địa chỉ: Số 123, Đường Nguyễn Văn A, Quận Bình Thạnh, TP.HCM</p>
            <p>Tổng quan: Đặt lịch khám bệnh online giúp bạn dễ dàng chọn lịch hẹn và tiết kiệm thời gian.</p>
        </div>
        <div class="col-6">
            <p>Social platform</p>
            <div class="d-flex justify-content-center">
                <a class="nav-link mx-3">
                    <i class="fs-4 bi bi-facebook"></i>
                </a>
                <a class="nav-link mx-3">
                    <i class="fs-4 bi bi-google"></i>
                </a>

                <a class="nav-link mx-3">
                    <i class="fs-4 bi bi-twitter"></i>
                </a>

                <a class="nav-link mx-3">
                    <i class="fs-4 bi bi-github"></i>
                </a>
            </div>
        </div>
    </div>

</footer>
</body>
</html>
