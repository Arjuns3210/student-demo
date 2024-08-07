<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('teacher');

        if ($request->has('search')) {
            $query->where('student_name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('teacher', function($q) use ($request) {
                      $q->where('teacher_name', 'like', '%' . $request->search . '%');
                  });
        }

        $students = $query->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('students.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:255',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $teachers = Teacher::all();
        return view('students.edit', compact('student', 'teachers'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:255',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
