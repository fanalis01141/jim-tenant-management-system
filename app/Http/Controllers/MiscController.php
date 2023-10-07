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
        $parts = explode("-", $request->store_name);
        $branch = trim($parts[1]);
        $store_name = trim($parts[0]);

        Misc::create([
            'store_name' => $store_name,
            'branch' => $branch,
            'misc' => $request->misc_type,
            'amount' => $request->amount,
            'date_paid' => $request->date_paid,
        ]);

        Session::flash('success', 'Water record added.');
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
    public function update(Request $request, $id)
    {

        Misc::where('id', $request->id)->update([
            'amount' => $request->amount,
            'date_paid' => $request->date_paid,
        ]);

        Session::flash('success', 'Misc details has been updated!');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Misc::where('id', $id)->delete();
        return Response::json('User deleted successfully');    
    }
}
