// public/js/script.js

$(document).ready(function () {
    // Mini Cart Trigger Button Click Event
    $("#mini-cart-trigger").on("click", function () {
        // Load Mini Cart Content via Ajax
        loadMiniCart();
    });

    // Load Mini Cart on page load
    loadMiniCart();

    // Close Mini Cart when clicking outside of it
    $(document).on("click", function (event) {
        if (!$(event.target).closest("#mini-cart-container, #mini-cart-trigger").length) {
            $("#mini-cart-container").fadeOut();
        }
    });
});

// Function to load Mini Cart content via Ajax
function loadMiniCart() {
    $.ajax({
        url: "/cart",
        type: "GET",
        dataType: "html",
        success: function (data) {
            $("#mini-cart-container").html(data);
            $("#mini-cart-container").fadeIn();
        },
        error: function (error) {
            console.log("Ajax request failed:", error);
        }
    });
}

// Function to update cart via Ajax
function updateCart() {
    $.ajax({
        url: "/cart/update",
        type: "POST",
        data: $("#update-cart-form").serialize(),
        dataType: "json",
        success: function (response) {
            // Handle success (if needed)
        },
        error: function (error) {
            console.log("Ajax request failed:", error);
        }
    });
}
