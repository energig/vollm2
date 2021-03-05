<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Gate;
use App\User;
use App\Role;

class UsersController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}
	
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::all();
        return view('admin.users.index')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if (Gate::denies('edit-users')) {
			return redirect(route('admin.users.index'));
		}
		
		$roles = Role::all();
		
		return view('admin.users.create')->with('roles', $roles);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validatedData = $request->validate([
		  'name' => ['required', 'string'],
		  'email' => ['required', 'email', 'unique:users'],
		  'password' => ['required', 'string'],
		],
		[
			'required' => 'Bitte Daten einsetzen',
		]);

		$validatedData['password'] = Hash::make($validatedData['password']);
		
		$user = User::create($validatedData);
		
		$user->roles()->sync($request->roles);
		
		if ($user->save()) {
			$request->session()->flash('success', 'Benutzer ' . $user->name . ' erstellt');
		} else {
			$request->session()->flash('error', 'Fehler beim Erstellen des Benutzers ' . $user->name);
		}
		
		return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
		if (Gate::denies('edit-users')) {
			return redirect(route('admin.users.index'));
		}
		
		$roles = Role::all();
		
		return view('admin.users.edit')->with([
			'user' => $user,
			'roles' => $roles,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
		
		$user->name = $request->name;
		$user->email = $request->email;
		
		if ($user->save()) {
			$request->session()->flash('success', 'Benutzer ' . $user->name . ' aktualisiert');
		} else {
			$request->session()->flash('error', 'Fehler beim Aktualisieren des Benutzers ' . $user->name);
		}
		
		return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
		if (Gate::denies('delete-users')) {
			return redirect(route('admin.users.index'));
		}
		
        $user->roles()->detach();
		$user->delete();
		
		return redirect()->route('admin.users.index');
    }
}
