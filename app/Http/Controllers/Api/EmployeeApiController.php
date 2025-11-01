<?php

namespace App\Http\Controllers\Api;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; // ✅ Add this

//  Resources
use App\Http\Resources\EmployeeResource;

// Models
use App\Models\Employee;
use App\Models\Coa;

class EmployeeApiController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'cnic' => 'required|string|unique:employees,cnic',
            'cell_no1' => 'nullable|string|max:15',
            'cell_no2' => 'nullable|string|max:15',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        return DB::transaction(function () use ($validated) {
            // ✅ 1. Create Employee
            $employee = Employee::create($validated);

            // ✅ 2. Create related COA
            Coa::create([
                'coa_sub_id'   => 17,
                'code'         => 'EMP-' . str_pad($employee->id, 4, '0', STR_PAD_LEFT),
                'title'        => "{$employee->first_name} {$employee->last_name}",
                'type'         => 'expense',
                'status'       => 'Active',
                'employee_id'  => $employee->id,
            ]);

            // ✅ 3. Return Response
            return response()->json([
                'success' => true,
                'message' => 'Employee and related COA created successfully.',
                'data' => new EmployeeResource($employee->load('city', 'role')),
            ], 201);
        });
    }


    // Show method with improved error handling   
    public function show($id): JsonResponse
    {
        try {
            // Try to find the employee with related data
            $employee = Employee::with(['role', 'city'])->find($id);

            // If not found, return a clear 404 response
            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found.',
                ], 404);
            }

            // Return successful response
            return response()->json([
                'success' => true,
                'message' => 'Employee retrieved successfully.',
                'data' => new EmployeeResource($employee),
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Database or query error (bad SQL, missing table, etc.)
            return response()->json([
                'success' => false,
                'message' => 'Database query error: ' . $e->getMessage(),
            ], 500);

        } catch (\Exception $e) {
            // Catch any unexpected exception
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => ['required','email', Rule::unique('employees','email')->ignore($employee->id)],
            'cnic'       => ['required','string', Rule::unique('employees','cnic')->ignore($employee->id)],
            'cell_no1'   => 'nullable|string|max:15',
            'cell_no2'   => 'nullable|string|max:15',
            'city_id'    => 'required|exists:cities,id',
            'address'    => 'required|string',
            'role_id'    => 'required|exists:roles,id',
            'status'     => 'required|in:Active,Inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        return DB::transaction(function () use ($employee, $request) {
            // ✅ 1. Update Employee record
            $employee->update($request->all());

            // ✅ 2. Find existing COA record
            $coa = Coa::where('employee_id', $employee->id)->first();

            if ($coa) {
                // ✅ 3. Update existing COA
                $coa->update([
                    'title'  => "{$employee->first_name} {$employee->last_name}",
                    'status' => ucfirst($employee->status),
                ]);
            } else {
                // ✅ 4. Recreate COA if missing
                Coa::create([
                    'coa_sub_id'  => 17,
                    'code'        => 'EMP-' . str_pad($employee->id, 4, '0', STR_PAD_LEFT),
                    'title'       => "{$employee->first_name} {$employee->last_name}",
                    'type'        => 'expense',
                    'status'      => ucfirst($employee->status ?? 'Active'),
                    'employee_id' => $employee->id,
                ]);
            }

            // ✅ 5. Return Response
            return response()->json([
                'success' => true,
                'message' => 'Employee and related COA updated successfully.',
                'data' => new EmployeeResource($employee->load('city', 'role')),
            ]);
        });
    }


    // Delete method with enhanced error handling
    public function destroy(Employee $employee): JsonResponse
    {
        try {
            // If employee not found (in case route model binding fails)
            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found.',
                ], 404);
            }

            // Attempt to delete
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully.',
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Database-related error (e.g. foreign key constraint)
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete employee due to related data.',
                'error' => $e->getMessage(),
            ], 409); // 409 Conflict

        } catch (\Exception $e) {
            // Any other unexpected error
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}