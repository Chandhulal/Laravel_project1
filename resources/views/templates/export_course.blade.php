<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Course_id</th>
        <th>Semester</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($course as $course)
        <tr>
            <td>{{ $course->name }}</td>
            <td>{{ $course->course_id }}</td>
            <td>{{ $course->semester }}</td>
            <td>{{ $course->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
