<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use DB;

class UsersController extends Controller
{
    public function index(){
        $users = DB::table('users')->get();
        return view('users', ['users' => $users]);
    }
}