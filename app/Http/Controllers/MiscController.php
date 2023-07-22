<?php

namespace App\Http\Controllers;

use App\Models\Misc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class MiscController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        Misc::create([
            'misc' => $request->misc,
            'amount' => $request->amount,
        ]);

        Session::flash('success', 'Added record for miscellaneous.');
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Misc $misc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Misc $misc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Misc $misc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Misc $misc)
    {
        //
    }
}
