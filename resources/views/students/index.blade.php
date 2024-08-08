@extends('layouts.app')

@section('content')
@if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('students.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search students or teachers">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped mx-auto" id="students-table" style="max-width: 1200px;">
            <thead>
                <tr>
                    <th>Id</th>
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
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->teacher->teacher_name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->admission_date }}</td>
                    <td>{{ $student->yearly_fees }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $students->links() }}
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
<script>
    $(document).ready(function() {
        $('#students-table').DataTable({
            paging: true,
            searching: true,
            info: true,
            lengthChange: false,
        });
    });
</script>
@endsection
