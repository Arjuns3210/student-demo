@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold mt-4" style="font-size: 40px;">Add Student</h1>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="student_name">Student Name</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" required>
                </div>
                <div class="form-group">
                    <label for="teacher_id">Class Teacher</label>
                    <select class="form-control" id="teacher_id" name="teacher_id" required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" class="form-control" id="class" name="class" required>
                </div>
                <div class="form-group">
                    <label for="admission_date">Admission Date</label>
                    <input type="date" class="form-control" id="admission_date" name="admission_date" required>
                </div>
                <div class="form-group">
                    <label for="yearly_fees">Yearly Fees</label>
                    <input type="number" class="form-control" id="yearly_fees" name="yearly_fees" required>
                </div>
                <button type="submit" class="btn btn-success">Add Student</button>
            </form>
        </div>
    </div>
</div>
@endsection
