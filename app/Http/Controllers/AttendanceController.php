<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $terms = Term::where('status', 'active')->get();
        $course_year_blocks = Student::select('course', 'year', 'block')
            ->groupBy('course', 'year', 'block')
            ->get();
        return view("main.attendance.index", compact("terms", "course_year_blocks"));
    }

    public function get_attendance(Request $request)
    {
        $this->generateAttendance();

        $date_req = $request->datepick;  // e.g. '08/10/2025'

        $formattedDate = Carbon::createFromFormat('m/d/Y', $date_req)->format('Y-m-d');

        $query = Attendance::with(['student', 'term']);

        if ($request->term_choice) {
            $query->whereHas('term', function ($q) use ($request) {
                $q->where('id', $request->term_choice);
            });
        }

        if ($request->course && $request->year && $request->block) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('course', $request->course)
                    ->where('year', $request->year)
                    ->where('block', $request->block);
            });
        }

        // Add filtering by attend_date
        $query->where('attend_date', $formattedDate);

        // Add order by lastname ascending and gender descending
        // Note: orderBy inside whereHas won't work, so order on main query joining students
        $query->join('students', 'attendances.student_id', '=', 'students.id')
            ->orderBy('students.gender', 'desc')
            ->orderBy('students.lastname', 'asc')
            ->select('attendances.*'); // select attendance columns after join

        return response()->json($query->get());
    }


    public function generateAttendance()
    {
        try {
            DB::statement('CALL insert_attendances_by_term()');

            // Optionally, return success message or updated count
            return response()->json([
                'success' => true,
                'message' => 'Attendance records inserted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to insert attendance records.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateAttendanceStatus(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'id' => 'required|integer|exists:attendances,id',  // Adjust 'attendances' to your actual table name
            'status' => 'required|string|in:present,absent',
        ]);

        try {
            // Hanapin yung record by id
            $attendance = Attendance::findOrFail($request->id);

            // Update status
            $attendance->status = $request->status;
            $attendance->save();

            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update status'], 500);
        }
    }
}
