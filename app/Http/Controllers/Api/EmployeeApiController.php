<?php

namespace App\Http\Controllers\Api;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;

//  Resources
use App\Http\Resources\EmployeeResource;

// Models
use App\Models\Employee;

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
            'cell_no1' => 'string|max:15',
            'cell_no2' => 'string|max:15',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:Active,Inactive',

            // 'salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::create($validated);

        return new EmployeeResource($employee);
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
        $data = $request->validate([
            'cnic' => ['required', Rule::unique('employees', 'cnic')->ignore($employee->id)],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'nullable', // make optional
                'email',
                Rule::unique('employees', 'email')->ignore($employee->id), // ignore same record
            ],
            'address' => 'nullable|string|max:255',
            'city_id' => 'nullable|integer',
            'cell_no1' => 'required|string|max:20',
            'cell_no2' => 'nullable|string|max:20',
            'image_path' => 'nullable|image',
            'role_id' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        // ✅ If email is not provided, keep old one (do not overwrite with null)
        if (!$request->filled('email')) {
            unset($data['email']);
        }

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('employees', 'public');
        }

        $employee->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Employee updated successfully.',
            'data' => $employee->fresh(),
        ]);
    }

    // public function update(Request $request, Employee $employee)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:employees,email',
    //         // 'cnic' => 'required|unique:employees,cnic,' . $employee->id,
    //         'cnic' => [
    //             'required',
    //             Rule::unique('employees', 'cnic')->ignore($employee->id),
    //         ],
    //         'cell_no1' => 'string|max:15',
    //         'cell_no2' => 'string|max:15',
    //         'city_id' => 'required|exists:cities,id',
    //         'address' => 'required|string',
    //         'status' => 'required|in:Active,Inactive',
    //         'role_id' => 'required|exists:roles,id',
    //         'status' => 'required|in:Active,Inactive',
    //    ]);

    //     $employee->update($validated);

    //     return new EmployeeResource($employee);
    // }


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