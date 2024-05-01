@vite(["resources/sass/app.scss", "resources/js/app.js"])
@include('admin.layout.nav')

<title>Manage customers</title>
<section style="margin-left: 272px; margin-right: 30px; padding: 18px; font-family: Inter">
    <h2 style="font-weight: bold" align="center"> MANAGE CUSTOMERS </h2>
    <table class="table table-striped mt-3">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
{{--            <td>Edit</td>--}}
{{--            <td>Delete</td>--}}
        </tr>
        @foreach($customers as $customer)
        <tr>
            <td> {{ $customer-> id }}</td>
            <td> {{ $customer -> name }}</td>
            <td> {{ $customer -> email }}</td>
            <td> {{ $customer -> address }}</td>
{{--            <td>--}}
{{--                <a class="nav-link link-primary" href="{{ route('customer.edit', $customer) }}"> Edit </a>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <form method="post" action="{{ route('customer.destroy', $customer) }}">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                </form>--}}
{{--            </td>--}}
        </tr>
        @endforeach
    </table>
</section>
