@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_name">Student Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name" value="{{ $student->student_name }}" required>
        </div>
        <div class="form-group">
            <label for="class_teacher_id">Class Teacher</label>
            <select class="form-control" id="class_teacher_id" name="class_teacher_id" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $student->class_teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->teacher_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="class">Class</label>
            <input type="text" class="form-control" id="class" name="class" value="{{ $student->class }}" required>
        </div>
        <div class="form-group">
            <label for="admission_date">Admission Date</label>
            <input type="date" class="form-control" id="admission_date" name="admission_date" value="{{ $student->admission_date }}" required>
        </div>
        <div class="form-group">
            <label for="yearly_fees">Yearly Fees</label>
            <input type="number" class="form-control" id="yearly_fees" name="yearly_fees" value="{{ $student->yearly_fees }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Student</button>
    </form>
</div>
@endsection
