@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section>
    <table class="table">
        @foreach($doctors as $doctor)
            <tr>
                <td>
                    <p>Doctor: {{$doctor -> name}}</p>
                    <p>Gender: {{$doctor -> gender -> name}}</p>
                    <p>Specialization: {{$doctor -> specialization -> name}}</p>
                    <p>{{$shift -> time}}</p>
                </td>
            </tr>
        @endforeach
    </table>
</section>

