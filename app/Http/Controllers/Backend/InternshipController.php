<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InternshipController extends Controller
{
    public function index()
    {
        $internships = Internship::all();
        return view('backend.layouts.internship.index', compact('internships'));
    }

    // Show the form for creating a new internship
    public function create()
    {
        return view('backend.layouts.internship.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'allowance' => 'nullable|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Remote',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Internship::create($request->all());
        Toastr::success('Internship created successfully.');
        return redirect()->route('internships.index');
    }

    // Display the specified internship
    public function show(Internship $internship)
    {
        return view('internships.show', compact('internship'));
    }

    // Show the form for editing the specified internship
    public function edit($id)
    {
        $internship = Internship::findOrFail($id);
        return view('backend.layouts.internship.edit', compact('internship'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'allowance' => 'required|numeric|min:1',
            'type' => 'required|string|in:Full-time,Part-time,Remote',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $internship = Internship::findOrFail($id);
        $internship->update($request->all());

        Toastr::success('Internship updated successfully.');
        return redirect()->route('internships.index');
    }

    public function destroy($id)
    {
        $internship = Internship::findOrFail($id);
        $internship->delete();

        Toastr::success('Internship deleted successfully.');
        return redirect()->route('internships.index');
    }
}
