<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cnic' => 'required|unique:employees',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'address' => 'nullable',
            'city_id' => 'nullable|integer',
            'cell_no1' => 'required',
            'cell_no2' => 'nullable',
            'image_path' => 'nullable|image',
            'role_id' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('employees', 'public');
        }

        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
            // dd('you are in update');
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


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}