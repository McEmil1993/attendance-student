<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Term;
use App\Models\Student;
use App\Models\StudentEnroll;

class AssessmentController extends Controller
{
    //
    public function index()
    {
        $assessment = Assessment::all();
        $terms = Term::where('status', 'active')->get();
        $course_year_blocks = Student::select('course', 'year', 'block')
            ->groupBy('course', 'year', 'block')
            ->get();
        return view('main.assessment.index', compact('assessment', 'terms', 'course_year_blocks'));
    }
    public function get_student_enroll(Request $request)
    {
        $query = StudentEnroll::with(['student', 'term', 'assessment']);

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

        if ($request->assessment_choice) {
            $query->whereHas('assessment', function ($q) use ($request) {
                $q->where('id', $request->assessment_choice);
            });
        }

        // Add order by lastname ascending and gender descending
        // Need to join or use whereHas with orderBy on relation:
        $query->whereHas('student', function ($q) {
            $q->orderBy('lastname', 'asc')
                ->orderBy('gender', 'desc');
        });

        return response()->json($query->get());
    }

    public function setScore(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'id' => 'required|integer|exists:student_enrolls,id',
            'score' => 'required|numeric|min:0',
        ]);

        // Hanapin ang record
        $studentEnroll = StudentEnroll::findOrFail($request->id);

        // I-set at i-save ang bagong score
        $studentEnroll->score = $request->score;
        $studentEnroll->save();

        return response()->json(['message' => 'Score updated successfully']);
    }
}
