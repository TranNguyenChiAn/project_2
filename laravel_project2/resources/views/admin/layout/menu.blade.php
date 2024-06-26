@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section style="margin: 0 0 0 260px;" >
    <div class="bg-white p-3 d-flex justify-content-between">
        <div class="d-flex fs-5 align-items-center">
            <i class="bi bi-search position-absolute mx-4 px-2"></i>
            <input class="form-control rounded-3 border-0 px-lg-5 p-2 mx-lg-3" type="text" name="search"
                   placeholder="Search something..." style="width: 420px">
        </div>

        <div class="d-flex fs-5 align-items-center">
            <i class="bi bi-bell mx-lg-3 bg-lime rounded-circle"></i>
            <img src="{{asset('./images/Fu_Xuan.webp')}}" width="42px" class="rounded-circle mx-lg-3">
        </div>
    </div>
</section>

