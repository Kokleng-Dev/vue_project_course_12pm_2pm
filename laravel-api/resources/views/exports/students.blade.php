<table>
    <tr>
        <td style="color: red">
            Company Name
        </td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->age }}</td>
            </tr>
        @endforeach
    </tbody>
</table>