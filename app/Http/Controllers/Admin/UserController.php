<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    // public function index() {
    //     return view('admin.home');
    // }

    public function index() {
       $users = User::paginate(15); 
    }
    
}
