<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view employee')->only(['index']);
        $this->middleware('can:create employee')->only(['create', 'store']);
        $this->middleware('can:edit employee')->only(['edit', 'update']);
        $this->middleware('can:delete employee')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::where(['is_employee' => '1', 'role' => 'admin'])->latest()->paginate(10);
        return view('admin.employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employee.create');
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
                'manager' => ['view companies', 'view jobs', 'edit companies', 'edit jobs', 'view job categories', 'create job categories', 'edit job categories', 'delete job categories', 'view employee', 'edit employee', 'create employee', 'delete employee', 'view blogs', 'create blogs', 'edit blogs', 'delete blogs', 'view blog categories', 'create blog categories', 'edit blog categories', 'delete blog categories', 'view pages', 'edit pages',],

                'editor' => ['view companies', 'view jobs', 'view blogs', 'create blogs', 'edit blogs', 'delete blogs', 'view blog categories', 'create blog categories', 'edit blog categories', 'delete blog categories', 'view pages', 'edit pages', 'view job application', 'edit job application'],
            ];


            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->role = 'admin';
            $user->password = bcrypt($request->input('password'));
            $user->email_verified_at = Carbon::now();
            $user->added_by = auth()->user()->id;
            $user->is_employee = '1';
            $user->employee_type = $request->input('employee_type');

            if ($request->input('employee_type') == 'manager') {

                $user->syncPermissions($roles['manager']);
            } else {
                $user->syncPermissions($roles['editor']);
            }


            $user->save();


            return redirect()->route('employee.index')->with('success', 'Employee added successfully.');

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
            'view companies',
            'edit companies',

            'view jobs',
            'edit jobs',

            'view job categories',
            'create job categories',
            'edit job categories',
            'delete job categories',

            'view employee',
            'edit employee',
            'create employee',
            'delete employee',

            'view blogs',
            'create blogs',
            'edit blogs',
            'delete blogs',

            'view blog categories',
            'create blog categories',
            'edit blog categories',
            'delete blog categories',

            'view pages',
            'edit pages',

            'view users',
            'edit users',
        ];
        return view('admin.employee.edit', ['employee' => $employee, 'permissions' => $permissions]);
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


            $permissions = [
                'manager' => [
                    'view companies',
                    'edit companies',

                    'view jobs',
                    'edit jobs',

                    'view job categories',
                    'create job categories',
                    'edit job categories',
                    'delete job categories',

                    'view employee',
                    'edit employee',
                    'create employee',
                    'delete employee',

                    'view blogs',
                    'create blogs',
                    'edit blogs',
                    'delete blogs',

                    'view blog categories',
                    'create blog categories',
                    'edit blog categories',
                    'delete blog categories',

                    'view pages',
                    'edit pages',

                    'view users',
                    'edit users',
                ],
                'editor' => [
                    'view companies',

                    'view jobs',
                    'edit jobs',

                    'view job categories',
                    'create job categories',
                    'edit job categories',
                    'delete job categories',

                    'view blogs',
                    'create blogs',
                    'edit blogs',
                    'delete blogs',

                    'view blog categories',
                    'create blog categories',
                    'edit blog categories',
                    'delete blog categories',

                    'view pages',
                    'edit pages',

                    'view users',
                    'edit users',
                ],
            ];


            $user = User::findOrFail($id);

            $old_type = $user->employee_type;

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->role = 'admin';
            $user->added_by = auth()->user()->id;
            $user->is_employee = '1';
            $user->employee_type = $request->input('employee_type');

            if (!empty ($request->password)) {
                $user->password = bcrypt($request->input('password'));
            }



            if ($old_type != $request->employee_type || ($user->getAllPermissions()->isEmpty() && ($old_type != $request->employee_type))) {
                $user->syncPermissions($permissions[$request->employee_type]);
            } else {
                $user->syncPermissions($request->permissions);
            }


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
