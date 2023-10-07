<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth;

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

        $storeName = trim(explode('-', $request->tenants)[0]);

        $user = Tenants::where('store_name', $storeName)->first();

        // this will only happen when adding from admin panel
        if(auth()->user()->level == 'admin'){
            
            $timestamp = strtotime($request->date);
            $date = date('Y-m-d', $timestamp);
            $humanReadableDate = date('F j, Y', $timestamp);


            $existingPayment = Payments::whereDate('created_at', $date)->where('tenant_id', '=', $user->id)->first();

            if ($existingPayment) {
                return redirect()
                ->back()
                ->withErrors(['error' => 'Failed: Payment exists for '. $request->tenants . ' on ' . $humanReadableDate. '. Please update or delete the record instead.'])
                ->withInput();
            
            } else {
                // Create a new payment record
                Payments::insert([
                    'tenant_id' => $user->id,
                    'store_name' => $storeName,
                    'option' => $request->option,
                    'amount' => $user->amount_of_payment,
                    'branch' => $user->branch,
                    'created_at' => $date,
                ]);                
                Session::flash('success', 'Payment for ' . ucwords($storeName). ' added successfully!');
                return Redirect::back();
            }

        }else{ //for encoder side
            if ($user) {
                Payments::create([
                    'tenant_id' => $user->id,
                    'store_name' => $storeName,
                    'option' => $request->option,
                    'amount' => $user->amount_of_payment,
                    'branch' => $user->branch,
                ]);
                Session::flash('success', 'Payment for ' . ucwords($storeName). ' added successfully!');
                return Redirect::back();
            } else {
                Session::flash('error', 'Cash Payment Failed: User '. $request->tenants .' does not exist.');
                return Redirect::back();
            }
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
        Payments::where('id', $request->paymentIdInput)->update([
            'amount' => $request->amountInput,
            'option' => $request->option,
        ]);

        Session::flash('success', 'Payment details has been updated!');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payments::where('id', $id)->delete();
        return Response::json('User deleted successfully');
    }
}
