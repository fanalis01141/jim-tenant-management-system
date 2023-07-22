<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ExpensesController extends Controller
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
        Expenses::create([
            'branch' => $request->branch,
            'choice_1' => $request->choice_1,
            'choice_2' => $request->choice_2,
            'amount' => $request->amount,
        ]);

        Session::flash('success', 'Expense for ' . $request->choice_1 .' - '. $request->choice_2 . ' added successfully!');
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        //
    }
}
