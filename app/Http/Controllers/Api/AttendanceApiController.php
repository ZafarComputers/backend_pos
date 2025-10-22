<?php

namespace App\Http\Controllers\Api;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Resources
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\CompactAttendanceResource;
use App\Http\Resources\EmployeeAttendanceResource;

// Models
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceApiController extends Controller
{
    /**
     * Display a listing of all attendances (all employees combined).
     */
    public function allAttendances()
    {
        // Load all employees with their attendances
        $employees = Employee::with('attendances')->get();

        return response()->json([
            'success' => true,
            'message' => 'Attendance records grouped by employees retrieved successfully.',
            'data' => CompactAttendanceResource::collection($employees),
        ]);
    }

    
    /**
     * Display a listing of the employee's attendance.
     */
    public function index(Employee $employee)
    {
        // load attendances (and optionally roles/city used in resource)
        $employee->load(['attendances' => function($q) {
            $q->latest(); // optional ordering; add ->paginate(...) if you want pagination
        }, 'role', 'city']);

        return response()->json([
            'success' => true,
            'message' => "Attendance list for {$employee->first_name} retrieved successfully.",
            'data' => new EmployeeAttendanceResource($employee),
        ]);
    }


    /**
     * Store a newly created attendance record for an employee.
     */
    public function store(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'date' => [
                'required',
                'date',
                Rule::unique('attendances')->where(fn($q) => $q->where('employee_id', $employee->id)),
            ],
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|in:present,absent,late,half-day,leave',
            'remarks' => 'nullable|string|max:255',
        ]);

        $validated['employee_id'] = $employee->id;

        $attendance = Attendance::create($validated);

        return response()->json([
            'success' => true,
            'message' => "Attendance marked successfully for {$employee->first_name}.",
            'data' => new AttendanceResource($attendance->load('employee')),
        ], 201);
    }

    /**
     * Display a specific attendance record for an employee.
     */
    public function show(Employee $employee, Attendance $attendance)
    {
        if ($attendance->employee_id !== $employee->id) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance record does not belong to this employee.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance retrieved successfully.',
            'data' => new AttendanceResource($attendance->load('employee')),
        ]);
    }

    /**
     * Update a specific attendance record for an employee.
     */
    public function update(Request $request, Employee $employee, Attendance $attendance)
    {
        if ($attendance->employee_id !== $employee->id) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance record does not belong to this employee.',
            ], 403);
        }

        $validated = $request->validate([
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'sometimes|in:present,absent,late,half-day,leave',
            'remarks' => 'nullable|string|max:255',
        ]);

        $attendance->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Attendance updated successfully.',
            'data' => new AttendanceResource($attendance->load('employee')),
        ]);
    }

    /**
     * Remove a specific attendance record for an employee.
     */
    public function destroy($employeeId, $attendanceId)
    {
        // 🧩 Find the employee
        $employee = Employee::find($employeeId);
        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found.',
            ], 404);
        }

        // 🧩 Find the attendance
        $attendance = Attendance::find($attendanceId);
        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance record not found.',
            ], 404);
        }

        // 🧩 Check if the attendance belongs to this employee
        if ($attendance->employee_id !== $employee->id) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance record does not belong to this employee.',
            ], 403);
        }

        // 🧩 Delete safely
        try {
            $attendance->delete();

            return response()->json([
                'success' => true,
                'message' => 'Attendance deleted successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete attendance: ' . $e->getMessage(),
            ], 500);
        }
    }

}
