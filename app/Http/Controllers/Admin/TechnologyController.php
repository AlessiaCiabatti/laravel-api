<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Function\Helper;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function technologyProjects(){

        $technologies = Technology::all();
        return view('admin.technology-projects', compact('technologies'));
        // dd('technologyProjects');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val_data = $request->validate(
            [
                'name' => 'required|min:2|max:20'
            ],
            [
                'name.required' => 'You have to write the name of the technology.',
                'name.min' => 'Technology must have :min characters',
                'name.max' => 'Technology must not have more than :max characters'
            ],
        );

        $exist = Technology::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.technologies.index')->with('error', 'Already existing technology');
        } else {
            $new = new Technology();
            $new->name = $request->name;
            $new->slug = Helper::generateSlug($new->name, Technology::class);
            $new->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Added technology');
        }

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $val_data = $request->validate(
            [
                'name' => 'required|min:2|max:20'
            ],
            [
                'name.required' => 'You have to write the name of the technology.',
                'name.min' => 'Technology must have :min characters',
                'name.max' => 'Technology must not have more than :max characters'
            ],
        );

        $exist = Technology::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.technologies.index')->with('error', 'Already existing technology');
        } else {
            $val_data ['slug'] = Helper::generateSlug($request->name, Technology::class);
            $technology->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Modified technology');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Delete Thechnology');

    }
}
