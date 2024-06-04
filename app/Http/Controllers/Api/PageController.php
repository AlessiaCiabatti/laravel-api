<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('technology', 'types')->paginate(10);
        return response()->json($projects);
    }

    public function getTypes(){
        $types = Type::all();
        return response()->json($types);
    }

    public function getTechnologies(){
        $technologies = Technology::all();
        return response()->json($technologies);
    }

    public function getProjectBySlug($slug){
        $project = Project::where('slug', $slug)->with('technology', 'types', 'user')->first();
        if ($project) {
            $success = true;
            if ($project->image) {
                $project->image = asset('storage/' . $project->image);
            } else {
                $project->image = asset('storage/uploads/no-image.jpg');
                $project->image_original_name = 'no image';
            }
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'project'));
    }
}
