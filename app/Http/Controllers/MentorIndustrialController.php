<?php

namespace App\Http\Controllers;

use App\Models\MentorIndustrial;
use Illuminate\Http\Request;

class MentorIndustrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentoresIndustriales = MentorIndustrial::all();
    
        return view('mentoresIndustriales.index', compact('mentoresIndustriales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mentoresIndustriales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:mentor_industrials'],
        ]);
    
        $mentorIndustrial = new MentorIndustrial();
        $mentorIndustrial->name = $request->input('name');
        $mentorIndustrial->email = $request->input('email');
        $mentorIndustrial->save();
    
        return redirect()->route('mentoresIndustriales.index')->with('status', 'Mentor industrial creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MentorIndustrial  $mentorIndustrial
     * @return \Illuminate\Http\Response
     */
    public function show(MentorIndustrial $mentorIndustrial)
    {
        return view('mentoresIndustriales.show', compact('mentorIndustrial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MentorIndustrial  $mentorIndustrial
     * @return \Illuminate\Http\Response
     */
    public function edit(MentorIndustrial $mentorIndustrial)
    {
        return view('mentoresIndustriales.edit', compact('mentorIndustrial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MentorIndustrial  $mentorIndustrial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentorIndustrial $mentorIndustrial)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $mentorIndustrial->name = $request->input('name');
        $mentorIndustrial->email = $request->input('email');
        $mentorIndustrial->save();

        return redirect()->route('mentoresIndustriales.index')->with('status', 'Mentor industrial actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MentorIndustrial  $mentorIndustrial
     * @return \Illuminate\Http\Response
     */
    public function destroy(MentorIndustrial $mentorIndustrial)
    {
        $mentorIndustrial->delete();
    
        return redirect()->route('mentoresIndustriales.index')->with('status', 'Mentor industrial eliminado');
    }
}
