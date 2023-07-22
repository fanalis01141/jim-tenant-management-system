<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PaymentsController extends Controller
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
        $validated = $request->validate([
            'option' => 'required',
        ]);

        $user = Tenants::where('full_name', $request->tenants)->first();

        if ($user) {

            Payments::create([
                'tenant_id' => $user->id,
                'tenant_name' => $user->full_name,
                'option' => $request->option,
                'amount' => $user->amount_of_payment,
                'branch' => $user->branch,
            ]);

            Session::flash('success', 'Payment for ' .$user->full_name. ' added successfully!');
            return Redirect::back();

        } else {

            Session::flash('error', 'Cash Payment Failed: User '. $request->tenants .' does not exist.');
            return Redirect::back();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
