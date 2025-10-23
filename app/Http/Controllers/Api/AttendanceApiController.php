<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employee;
use App\Models\Attendance;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\EmployeeAttendanceResource;

class AttendanceApiController extends Controller
{
    /**
     * 🧩 Get all employees with their attendances
     */
    public function all()
    {

        $employees = Employee::with('attendances')->latest()->get();

    
        // $employees = Employee::with(['attendances'])
        //     ->latest()
        //     ->get();

        // $employees = Employee::with(['attendances' => fn($q) => $q->latest(), 'role', 'city'])
        //     ->latest()
        //     ->get();

        return response()->json([
            'success' => true,
            'message' => 'All employees with attendances retrieved successfully.',
            'data' => EmployeeAttendanceResource::collection($employees),
        ]);
    }

    /**
     * 🧩 Get attendance for one employee
     */
    public function index($employeeId)
    {
        $employee = Employee::with(['attendances' => fn($q) => $q->latest(), 'role', 'city'])
            ->find($employeeId);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "Attendance list for {$employee->first_name} retrieved successfully.",
            'data' => new EmployeeAttendanceResource($employee),
        ]);
    }

    /**
     * 🧩 Store attendance for an employee
     */
    public function store(Request $request, $employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee not found.'], 404);
        }

        $validated = $request->validate([
            'date' => [
                'required', 'date',
                Rule::unique('attendances')->where(fn($q) => $q->where('employee_id', $employeeId)),
            ],
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|in:present,absent,late,half-day,leave',
            'remarks' => 'nullable|string|max:255',
        ]);

        $validated['employee_id'] = $employeeId;

        $attendance = Attendance::create($validated);

        return response()->json([
            'success' => true,
            'message' => "Attendance added for {$employee->first_name}.",
            'data' => new AttendanceResource($attendance),
        ], 201);
    }

    /**
     * 🧩 Update attendance for an employee
     */
    public function update(Request $request, $employeeId, $attendanceId)
    {
        $employee = Employee::find($employeeId);
        $attendance = Attendance::find($attendanceId);

        if (!$employee || !$attendance) {
            return response()->json(['success' => false, 'message' => 'Record not found.'], 404);
        }

        if ($attendance->employee_id !== $employee->id) {
            return response()->json(['success' => false, 'message' => 'Attendance does not belong to this employee.'], 403);
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
            'data' => new AttendanceResource($attendance),
        ]);
    }

    /**
     * 🧩 Delete attendance for an employee
     */
    public function destroy($employeeId, $attendanceId)
    {
        $attendance = Attendance::where('employee_id', $employeeId)->find($attendanceId);

        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Attendance not found.'], 404);
        }

        $attendance->delete();

        return response()->json(['success' => true, 'message' => 'Attendance deleted successfully.']);
    }
}
