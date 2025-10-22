<?php

namespace App\Http\Controllers;

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
        $data = $request->validate([
            'cnic' => 'required|unique:employees,cnic,' . $employee->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
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

        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
