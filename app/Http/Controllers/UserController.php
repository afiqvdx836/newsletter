<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $newsletters = Newsletter::all();

        return view('user.index', compact('newsletters'));
    }

    public function details($id){
        $newsletter = Newsletter::findOrFail($id);
        return view('user.details', compact('newsletter'));
    }
}
