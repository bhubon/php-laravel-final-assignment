<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CompanyEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::where(['is_employee' => '1', 'added_by' => auth()->user()->id])->latest()->paginate(10);
        return view('company.employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|min:8|confirmed',
            'employee_type' => 'required|string',
        ]);

        try {

            $roles = [
                'manager' => [
                    'create jobs',
                    'view jobs',
                    'edit jobs',
                    'delete jobs',

                    'view employee',
                    'edit employee',
                    'create employee',
                    'delete employee',

                    'view job application',
                    'edit job application',
                ],

                'editor' => [
                    'view jobs',
                    'edit jobs',

                    'view job application',
                    'edit job application',
                ],
            ];


            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->role = 'company';
            $user->password = bcrypt($request->input('password'));
            $user->added_by = auth()->user()->id;
            $user->is_employee = '1';
            $user->employee_type = $request->input('employee_type');

            if ($request->input('employee_type') == 'manager') {

                $user->syncPermissions($roles['manager']);
            } else {
                $user->syncPermissions($roles['editor']);
            }


            $user->save();


            return redirect()->route('employee-manager.index')->with('success', 'Employee added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add Employee. Please try again.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (auth()->user()->id == $id) {
            return redirect()->back()->with('warning', 'Dont have permission to access this page');
        }

        $employee = User::findOrFail($id);
        $permissions = [
            'create jobs',
            'view jobs',
            'edit jobs',
            'delete jobs',

            'view employee',
            'edit employee',
            'create employee',
            'delete employee',

            'view job application',
            'edit job application',
        ];
        return view('company.employee.edit', ['employee' => $employee, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'phone' => 'required|string',
            'password' => 'nullable|min:8|confirmed',
            'employee_type' => 'required|string',
        ]);

        try {

            $user = User::findOrFail($id);
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->role = 'company';
            $user->added_by = auth()->user()->id;
            $user->is_employee = '1';
            $user->employee_type = $request->input('employee_type');

            if (!empty($request->password)) {
                $user->password = bcrypt($request->input('password'));
            }



            $user->syncPermissions($request->permissions);


            $user->save();


            return redirect()->back()->with('success', 'Employee Updated.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to Updated Employee. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->back()->with('success', 'Employee Deleted.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to Delete Employee. Please try again.');
        }
    }
}
