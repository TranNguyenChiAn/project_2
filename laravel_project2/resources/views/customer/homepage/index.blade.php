@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section>
    <div class="container text-center">
            <div class="row row-cols-3">
                @if(count($doctors) != 0)
                    @foreach($doctors as $doctor)
                        <div class="col border bg-white">
                            <div
                                class="position-relative overflow-hidden d-flex justify-content-center">
                                <a href="/product/{{$doctor->id}}">
                                    <img
                                        src="{{ asset('./images/'. $doctor->image)}}"
                                        height="200px"
                                        class="p-1 mt-5"
                                        alt="product_image">
                                </a>
                                <div class="w-100 mt-3 position-absolute d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="p-1">
                                                {{$doctor->gender->name}}
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 text-capitalize">
                                <p>{{$doctor->name}}</p>
                                <p>{{$doctor->specialization->name}}</p>
                                <p class="text-success">
                                    Contact number: {{$doctor->contact_number}}
                                </p>
                            </div>
                            <div class="mt-5 mb-3 d-flex justify-content-center align-items-center">
                                <div class="d-flex justify-content-end">
                                    <a href="/product/{{$doctor->id}}"
                                       class="btn btn-light border rounded-5">
                                        <span class="px-2">View details</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex vh-100 w-100 align-items-start justify-content-center fs-5">
                        No result
                    </div>
                @endif
            </div>
        </div>
</section>
