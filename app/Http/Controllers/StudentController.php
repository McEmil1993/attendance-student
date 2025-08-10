<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        // Logic to retrieve and display students
        $students = Student::all();
        return view('main.student_manage.index', compact('students'));
    }

    public function student_list()
    {
        // Kunin lahat ng students
        $students = Student::select(
            'id',
            'id_number',
            'firstname',
            'middle_initial',
            'lastname',
            'course',
            'year',
            'block'
        )->get();

        // Optional: format ng full name at course-year-block
        $students->transform(function ($student) {
            $student->id_num = $student->id_number;
            $student->name = trim("{$student->lastname}, {$student->firstname}");
            $student->course_info = "{$student->course} - {$student->year}" . 
                                    ($student->block ? " Block {$student->block}" : "");
            return $student;
        });

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_number'        => 'required|string|max:10',
            'firstname'        => 'required|string|max:255',
            'middle_initial'   => 'nullable|string|max:5',
            'lastname'         => 'required|string|max:255',
            'gender'           => 'required|string|max:10',
            'address'          => 'nullable|string',
            'student_profile_path' => 'nullable|string|max:255',
            'course'           => 'required|string|max:255',
            'year'             => 'required|string|max:255',
            'block'            => 'nullable|string|max:255',
        ]);

        Student::create($request->all());

        return response()->json([
            'message' => 'Student saved successfully!'
        ]);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    // UPDATE Student Data
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:students,id',
            'id_number' => 'nullable|string|max:10',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:5',
            'gender' => 'required|string',
            'course' => 'nullable|string|max:100',
            'year' => 'nullable|integer',
            'block' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
        ]);

        $student = Student::findOrFail($request->id);
        $student->update($request->all());

        return response()->json([
            'message' => 'Student updated successfully!'
        ]);
    }
}
