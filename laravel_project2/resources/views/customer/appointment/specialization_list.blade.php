@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section>
    <table class="table">
        @foreach($specializations as $specialization)
            <tr>
                <td>
                    <p>{{$specialization -> name}}</p>
                </td>
            </tr>
        @endforeach
    </table>
</section>

