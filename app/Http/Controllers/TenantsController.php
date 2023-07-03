<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class TenantsController extends Controller
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
        $maxId = \DB::table('users')
        ->max('id');
        
        $users = Tenants::query()
        ->orderBy('full_name', 'asc')
        ->get();        

        return view('tenant.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $utility = json_encode($request->utility);
        $validated = $request->validate([
            'phone' => 'required|size:11',
        ]);
        

        Tenants::create([
            'store_name' => $request->store_name,
            'branch' => $request->branch,
            'full_name'=> $request->last_name.', '.$request->first_name,
            'sex' => $request->sex,
            'phone_number' => $request->phone,
            'complete_address' => $request->address,
            'utility' => $utility,
            'mode_of_payment' => $request->mop,
            'amount_of_payment' => $request->amount,
            'start_date' => $request->date,
            'start_time' => $request->time,
        ]);

        Session::flash('success', 'Tenant added successfully!');
        return Redirect::back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Tenants $tenants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenants $tenants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenants $tenants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenants $tenants)
    {
        //
    }
}
