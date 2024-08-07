@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Students</h1>
    <form action="{{ route('students.index') }}" method="GET">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search students or teachers">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    <table class="table" id="students-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class Teacher</th>
                <th>Class</th>
                <th>Admission Date</th>
                <th>Yearly Fees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->teacher->teacher_name }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->admission_date }}</td>
                <td>{{ $student->yearly_fees }}</td>
                <td>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $students->links() }}
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#students-table').DataTable();
    });
</script>
@endsection
