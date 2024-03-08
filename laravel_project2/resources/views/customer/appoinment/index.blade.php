<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>Image</th>
    </tr>
@foreach($doctors as $doctor)
    <tr>
        <td>
            <img src="{{ asset('./images/' . $doctor->image)}}" width="100px" height="100px">
        </td>
        <td>
            <a href="{{ route('doctor.edit', $doctor) }}">Edit</a>
        </td>
    </tr>
    @endforeach
</table>
