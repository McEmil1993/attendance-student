<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HandleStudent;

class HandleStudentController extends Controller
{
    // This controller can be used to handle student-related operations
    // such as creating, updating, deleting, and retrieving student records.
    
    // Example method to show a list of students
    public function index()
    {
        $handles = HandleStudent::with(['instructor', 'student'])->get();
        // Logic to retrieve and return a list of students
        return view('main.student_enroll.index', compact('handles'));
    }
    

    public function assign(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|integer|exists:users,id',
            'room_assign'   => 'required|string|max:100',
        ]);

        // Tawag sa stored procedure
        DB::statement('CALL assign_students_to_instructor(?, ?)', [
            $request->instructor_id,
            $request->room_assign
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Students assigned successfully.'
        ]);
    }

    // Additional methods for handling student operations can be added here
}
