<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function student() {
          if (Auth::user()->user_type !== 'student') {
            abort(403);
        }   

        return view('student.dashboard');

    }
    
    public function admin() {
          if (Auth::user()->user_type !== 'admin') {
            abort(403);
        }

        return view('student.dashboard');
    }
}
