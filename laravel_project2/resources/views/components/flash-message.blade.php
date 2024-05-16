@if (session()->has('success'))
    <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)"
         class="alert alert-success position-absolute" role="alert"
         style="top: 1%; right: 30%; box-shadow: 1px 1px blue; height: 60px;
         background-color: white">
        <p>
            {{session('success')}}
        </p>
    </div>
@endif

@if (session()->has('unsuccessful'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3)
         "x-show="show"
         class="alert alert-danger position-absolute" role="alert"
         style="top: 1%; right: 30%; box-shadow: 1px 1px crimson; height: 60px; animation: fadeOut 5s;">
        <p>
            {{session('unsuccessful')}}
        </p>
    </div>
@endif

<script>
    function showAutoDismissAlert(message, duration) {
        alert(message); // Hiển thị thông báo

        // Đặt thời gian tự động đóng sau 'duration' giây
        setTimeout(function() {
            let alertBox = document.querySelector('.alert');
            if (alertBox) {
                alertBox.style.display = 'none'; // Ẩn thông báo
            }
        }, duration * 1000); // Chuyển đổi giây sang mili giây
    }

</script>
