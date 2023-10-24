<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{


    //to reuce duplication of code
    private function validateEmployeeData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'salary' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Name field is required.',
            'phone.required' => 'Phone field is required.',
            'salary.required' => 'Salary field is required.',
        ]);
    }


    public function index()
    {
        $allEmployeeData = Employee::orderBy('id', 'desc')->paginate(5);
        return view('employee.index', ['allEmployees' => $allEmployeeData]);
    }


    public function create()
    {
        return view('employee.form');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'salary' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [

            'name.required' => 'Name field is required.',
            'phone.required' => 'Phone field is required.',
            'salary.required' => 'Salary field is required.',

        ]);

        $employeeData = $request->all();

        if ($image = $request->file('image')) {
            $imageDestination = "image/";
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestination, $imageName);
            $employeeData['image'] = "$imageName";
        }

        Employee::create($employeeData);
        return redirect()->route('employee.index')->with('success', 'Employee added successfully');
    }


    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }


    public function edit(Employee $employee)
    {
        return view('employee.form', compact('employee'));
    }


    public function update(Request $request, Employee $employee)
    {
        //for validation, from above private method
        $this->validateEmployeeData($request);

        $employeeData = $request->all();

        if ($image = $request->file('image')) {
            $imageDestination = "image/";
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestination, $imageName);
            $employeeData['image'] = "$imageName";
        } else {
            unset($employeeData['image']);
        }

        $employee->update($employeeData);
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }
}
