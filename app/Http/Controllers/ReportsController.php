<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\Expenses;
use App\Models\Misc;
use Carbon\Carbon;

class ReportsController extends Controller
{

    public function monthly (Request $request){
        // dd($request);

        $date = Carbon::parse($request->date);

        $carbonMonth = Carbon::createFromDate(null, $month, 1);
        $monthName = $carbonMonth->format('F'); // Parse month to string

        $totalPayments = Payments::whereDate('created_at', $date)->where('option','Payment')->where('branch', $request->branch)->sum('amount');
        $totalExpenses = Expenses::whereDate('created_at', $date)->where('branch', $request->branch)->sum('amount');
        $totalWater = Misc::whereDate('created_at', $date)->where('misc','water')->where('store_name', 'LIKE', $request->branch)->sum('amount');
        $totalElec = Misc::whereDate('created_at', $date)->where('misc','electricity')->where('store_name', 'LIKE', $request->branch)->sum('amount');
        
        $tenantsPayments = Payments::whereDate('created_at', $date)->where('branch', $request->branch)->get();
        $tenantsExpenses = Expenses::whereDate('created_at', $date)->where('branch', $request->branch)->get();
        $tenantsWater = Misc::whereDate('created_at', $date)->where('misc','water')->where('branch', $request->branch)->get();
        $tenantsElec = Misc::whereDate('created_at', $date)->where('misc','electricity')->where('branch', $request->branch)->get();

        $income = $totalPayments - $totalExpenses;
        
        return view('reports.monthly', compact('totalPayments', 'totalExpenses', 'totalWater', 'totalElec', 
                    'tenantsPayments', 'tenantsExpenses', 'tenantsWater', 'tenantsElec', 'income', 'monthName', 'year', 'branch'));
    }
}
