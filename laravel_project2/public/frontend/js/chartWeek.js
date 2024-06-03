// public/js/appointments-chart.js
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('appointmentsChart').getContext('2d');
    let appointmentsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Số lượng Cuộc hẹn',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function fetchAppointmentsData(month) {
        $.ajax({
            url: "/get-appointments-data",
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                month: month
            },
            success: function(response) {
                const labels = response.labels.map(label => {
                    const date = new Date(label);
                    return date.getDate();
                });
                appointmentsChart.data.labels = labels;
                appointmentsChart.data.datasets[0].data = response.data;
                appointmentsChart.update();
            }
        });
    }

    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        const month = $('input[name="month"]').val();
        fetchAppointmentsData(month);
    });

    // Lấy dữ liệu ban đầu cho tháng hiện tại
    const currentDate = new Date();
    fetchAppointmentsData(currentDate.toISOString().substring(0, 7));
});
