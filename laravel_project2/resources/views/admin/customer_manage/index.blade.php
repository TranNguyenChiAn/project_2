@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Manage customers</title>
<section style="margin-left: 272px; margin-right: 30px; padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE CUSTOMERS </h2>
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        @foreach($customers as $customer)
        <tr>
            <td> {{ $customer-> id }}</td>
            <td> {{ $customer -> name }}</td>
            <td> {{ $customer -> email }}</td>
            <td> {{ $customer -> phone }}</td>
            <td> {{ $customer -> address }}</td>
        </tr>
        @endforeach
    </table>
</section>
