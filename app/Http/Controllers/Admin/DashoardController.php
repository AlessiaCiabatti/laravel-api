<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashoardController extends Controller
{
    public function index(){

        $count_project = Project::count();

        $last_project = Project::orderBy('id', 'desc')->first();


        return view('admin.home', compact('count_project', 'last_project'));
    }
}
