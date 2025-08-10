<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileLog;
use App\Models\Student;

class StudentProfileController extends Controller
{
    //
    public function index()
    {
        return view("student_login");
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
            return response()->json([
                'message' => 'Login attempt logged successfully.'
            ]);
        } else {
            return response()->json([
                'message' => 'Student not found.'
            ]);
        }
    }
}
