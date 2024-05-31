// // public/js/script.js
//
// $(document).ready(function () {
//     // Mini Cart Trigger Button Click Event
//     $("#mini-cart-trigger").on("click", function () {
//         // Load Mini Cart Content via Ajax
//         loadMiniCart();
//     });
//
//     // Load Mini Cart on page load
//     loadMiniCart();
//
//     // Close Mini Cart when clicking outside of it
//     $(document).on("click", function (event) {
//         if (!$(event.target).closest("#mini-cart-container, #mini-cart-trigger").length) {
//             $("#mini-cart-container").fadeOut();
//         }
//     });
//
//     $('[data-toggle="tooltip"]').tooltip()
// });
//
// // Function to load Mini Cart content via Ajax
// function loadMiniCart() {
//     $.ajax({
//         url: "/cart",
//         type: "GET",
//         dataType: "html",
//         success: function (data) {
//             $("#mini-cart-container").html(data);
//             $("#mini-cart-container").fadeIn();
//         },
//         error: function (error) {
//             console.log("Ajax request failed:", error);
//         }
//     });
// }
//
// // Function to update cart via Ajax
// function updateCart() {
//     $.ajax({
//         url: "/cart/update",
//         type: "POST",
//         data: $("#update-cart-form").serialize(),
//         dataType: "json",
//         success: function (response) {
//             // Handle success (if needed)
//         },
//         error: function (error) {
//             console.log("Ajax request failed:", error);
//         }
//     });
// }
//
// // Sử dụng Fetch API
// fetch('/get-dates')
//     .then(response => response.json())
//     .then(data => {
//         // Xử lý dữ liệu
//         data.forEach(date => {
//             // Lấy timestamp từ mô hình Laravel
//             let timestamp = Date.parse(date.appointment_time);
//
//             // Tạo đối tượng Date từ timestamp
//             let jsDate = new Date(timestamp);
//
//             // Lấy thông tin ngày và giờ
//             let year = jsDate.getFullYear();
//             let month = jsDate.getMonth() + 1;
//             let day = jsDate.getDate();
//             let hour = jsDate.getHours();
//             let minute = jsDate.getMinutes();
//             let second = jsDate.getSeconds();
//
//             // Hiển thị ngày và giờ
//             console.log("Ngày: " + day + "/" + month + "/" + year);
//             console.log("Giờ: " + hour + ":" + minute + ":" + second);
//         });
//     })
//     .catch(error => console.error('Lỗi:', error));
//
