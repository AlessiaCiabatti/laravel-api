<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Function\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
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
                'name.required' => 'You have to write the name of the type.',
                'name.min' => 'Type must have :min characters',
                'name.max' => 'Type must not have more than :max characters'
            ],
        );

        $exist = Type::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Already existing type');
        } else {
            $new = new Type();
            $new->name = $request->name;
            $new->slug = Helper::generateSlug($new->name, Type::class);
            $new->save();

            return redirect()->route('admin.types.index')->with('success', 'Added type');
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
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate(
            [
                'name' => 'required|min:2|max:20'
            ],
            [
                'name.required' => 'You have to write the name of the type.',
                'name.min' => 'Type must have :min characters',
                'name.max' => 'Type must not have more than :max characters'
            ],
        );


        $exist = Type::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Already existing type');
        } else {
            $val_data ['slug'] = Helper::generateSlug($request->name, Type::class);
            $type->update($val_data);

            return redirect()->route('admin.types.index')->with('success', 'Modified type');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Delete Thechnology');

    }
}
