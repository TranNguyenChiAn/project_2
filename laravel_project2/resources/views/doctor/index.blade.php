@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('doctor.layout.nav')

<title>Schedule</title>
<style>
    thead {
        background-color: #a2bbb8;
        height: 50px;
    }

    a{
        color: black;
        text-decoration: none;
    }
</style>
<section style="margin-left: 190px">
    <div class="container">
        <h2 class="mx-3"><b> Schedule </b></h2>
        <div class="container d-flex">
            <div class="card rounded-3" style="border: 2px solid #5b9591e0; width: 100%">
                <div class="card-body">
                    <div id="calendar" ></div>
                </div>
            </div>
            {{--            Today--}}
            <div class="card h-100" style="margin-left: 18px; border: 2px solid #5b9591e0; width: 260px">
                <div class="card-body d-flex flex-column">
                    <p><b> Today's customers </b></p>
                    @if($appointments_today_count > 0)
                        @foreach($appointments_today as $appointment_today)
                            <button class="btn rounded-3" style="background-color: #8ae8d4">
                                <a class="text-dark text-decoration-none" href="{{route('doctor.editAppointment', $appointment_today)}}">
                                    <div class="d-flex flex-column align-items-center">
                                        <p class="text-white m-0">{{$appointment_today -> time}}</p>
                                        <p class="m-0"><b>{{$appointment_today -> customer_name}}</b></p>
                                    </div>
                                </a>
                            </button>
                        @endforeach
                    @else
                        <p>No appointments for today.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {
            editable:true,
            initialView: 'dayGridMonth',
            backgroundColor: 'white',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                    @foreach ($appointments_today as $appointment_today) {
                    title: '{{ $appointment_today->customer_name }}',
                    start: '{{ $appointment_today->date }}',
                    url: '{{ route('doctor.editAppointment', $appointment_today)}}',
                    backgroundColor: '#5777dc',
                },
                @endforeach
            ],
        });
        calendar.render();
    });
</script>