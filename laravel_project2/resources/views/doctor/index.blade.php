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
<section style="margin-left: 260px; margin-right: 30px;">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between p-4">
                <h2 class="m-0" style="margin-top: 18px"><b> Schedule </b></h2>
                <button class="btn btn-primary rounded-5 p-2 px-3">
                    <a href="{{ route('appointment.create') }}" class="nav-link text-white">
                        Create New
                        <i class="bi bi-plus-square"></i>
                    </a>
                </button>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>

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
                    @foreach ($appointments as $appointment) {
                    title: 'Dr. {{ $appointment->doctor->name }}',
                    start: '{{ $appointment->date }}T{{ $appointment->time }}',
                    url: '{{ route('doctor.editAppointment', $appointment )}}',
                    backgroundColor: '#2f2ffe',
                },
                @endforeach
            ],

        });
        calendar.render();
    });
</script>