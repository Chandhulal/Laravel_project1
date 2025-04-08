<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        // $this->middleware('permission:add user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function login_authentication()
    {
        $user = ['email' => request()->user_email, 'password' => request()->user_password];
        if (Auth::attempt($user, true)) {
            return view('templates.course_home');
        } else {
            return redirect('/')->withErrors('This user doesnt Exist');
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('user.user_registration');
    }
    public function index()
    {
        $data = User::with('roles')->get();
        return view('actions.users.indux', ["data" => $data]);
    }

    public function create()
    {
        $data = Role::all();
        return view('actions.users.create', [
            'data' => $data,
        ]);
    }

    public function store()
    {
        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => request()->password,
        ]);

        Mail::to($user->email)->send(new UserMail($user->name));

        if (request()->roles) {
            $user->syncRoles(request()->roles);
            return redirect('/users')->with('status', 'Added succesfully');
        }
        $user->assignRole('student');
        return redirect('/')->with('status', 'Registered succesfully');
    }

    public function edit($id)
    {
        $data = User::find($id);
        $role_id = DB::table('model_has_roles')->where('model_id', '=', $id)->pluck('role_id')->toArray();
        $role  = Role::all()->pluck('name')->toArray();

        return view('actions.users.edit', [
            "data" => $data,
            "role_id" => $role_id,
            "role" => $role,
        ]);
    }

    public function update($id)
    {
        $data = User::find($id);
        $data->update([
            'name' => request()->name,
            'email' => request()->email,
        ]);
        $data->syncRoles(request()->roles);

        return redirect('/users')->with('status', 'edited succesfully');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('/users')->with('error', 'Deleted succesfully');
    }
}
