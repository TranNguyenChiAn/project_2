document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.getElementById('departmentSelect');

    departmentSelect.addEventListener('change', function () {
        const departmentId = this.value;
        fetchDoctorsByDepartment(departmentId);
    });

    function fetchDoctorsByDepartment(departmentId) {
        fetch(`/departments/${departmentId}/doctors`)
            .then(response => response.json())
            .then(data => {
                const doctorList = document.getElementById('doctorList');
                doctorList.innerHTML = '';
                data.forEach(doctor => {
                    const listItem = document.createElement('li');
                    listItem.textContent = doctor.name;
                    doctorList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});
