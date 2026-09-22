<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadTeacherController extends Controller
{
    //
    public function index(Request $request)
    {
        abort_unless($request->user()->isHeadTeacher(), 403);

        return view('Head_Teacher.dashboard');
    }
}
