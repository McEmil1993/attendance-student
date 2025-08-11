<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileLog;
use App\Models\Student;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class StudentProfileController extends Controller
{
    //
    public function index()
    {
        $stu = Auth::guard('student')->user();

        if (!$stu) {
            Log::warning('Student not authenticated.');
            abort(403, 'Unauthorized');
        }

        $student = DB::table('students')->where('id', $stu->id)->first();

        if (!$student) {
            Log::warning('Student not found for ID: ' . $stu->id);
            abort(404, 'Student not found');
        }

        return view('student_updates', compact('student'));
    }

    public function store(Request $request)
    {
        $idNumber = $request->input('id_number');

        $student = Student::where('id_number', $idNumber)->first();
        $fullname = $student ? ($student->lastname . ', ' . $student->firstname) : null;

        // Detect device type
        $userAgent = $request->userAgent();
        if (preg_match('/mobile/i', $userAgent)) {
            $deviceType = 'Mobile';
        } elseif (preg_match('/tablet/i', $userAgent)) {
            $deviceType = 'Tablet';
        } else {
            $deviceType = 'Desktop';
        }

        // Get IP from input (client_ip) or fallback to server IP
        $ip = $request->input('client_ip') ?? $request->ip();

        // Count previous attempts for this idNumber today
        $attemptCount = ProfileLog::where('id_number', $idNumber)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        // Save log entry anyway
        ProfileLog::create([
            'id_number'     => $idNumber,
            'fullname'      => $fullname,
            'ip_address'    => $ip,
            'device_type'   => $deviceType,
            'lat_long'      => $request->input('lat_long'),
            'status'        => $student ? 'Success' : 'Failed',
            'attempt_count' => $attemptCount,
            'user_agent'    => $userAgent
        ]);

        // Return message based on student existence
        if ($student) {

            Auth::guard('student')->login($student);
            $request->session()->regenerate();
            return response()->json([
                'status' =>'success',
                'message' => 'Login attempt logged successfully.'
            ]);
        } else {
            return response()->json([
                'status' =>'success',
                'message' => 'Student not found.'
            ]);
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:100',
            'middle_initial' => 'nullable|string|max:5',
            'lastname' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $student = Student::findOrFail($request->student_id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            // Optionally delete old image
            if ($student->image_path && File::exists(public_path($student->image_path))) {
                File::delete(public_path($student->image_path));
            }

            $student->student_profile_path = 'images/' . $filename;
        }

        $student->firstname = $request->firstname;
        $student->middle_initial = $request->middle_initial;
        $student->lastname = $request->lastname;
        $student->address = $request->address;
        $student->save();

        return response()->json(['success' => true]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        // Optional: invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // or wherever your login page is
    }
}
