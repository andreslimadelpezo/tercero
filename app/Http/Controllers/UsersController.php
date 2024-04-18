<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$users=DB::select("
        //SELECT * FROM users u 
        //JOIN roles r ON u.rol_id=r.rol_id
         //");
        //$users=User::all();

        $users=DB::table('users as u')
        ->join('roles as r','u.rol_id','=','r.rol_id')
        ->select('*')
        ->get();
        return view('users.index')
        ->with('users',$users);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles=Roles::all();
        return view('users.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $input=$request->all();
       User::create($input);
       
       return Redirect(route('users.index'));
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($usu_id)
    {
        //
        $user=User::find($usu_id);
        $roles=Roles::all();
        return view( 'users.edit')->with([ 'user'=>$user,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$usu_id)
    {
        //
        $input=$request->all();
        $user=User::find($usu_id);
        $user->update($input);
        return Redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rol_id)
    {
        //
        $users=User::find($rol_id); 
        $users->delete();
        return Redirect(route('users.index'));

    }
}
