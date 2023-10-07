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
        $month = $date->month;
        $year = $date->year;
        $branch = $request->branch;

        $carbonMonth = Carbon::createFromDate(null, $month, 1);
        $monthName = $carbonMonth->format('F'); // Parse month to string

        $totalPayments = Payments::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('option','Payment')->where('branch', $request->branch)->sum('amount');
        $totalExpenses = Expenses::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('branch', $request->branch)->sum('amount');
        $totalWater = Misc::whereYear('date_paid', $year)->whereMonth('date_paid', $month)->where('misc','water')->where('branch', $request->branch)->sum('amount');
        $totalElec = Misc::whereYear('date_paid', $year)->whereMonth('date_paid', $month)->where('misc','electricity')->where('branch', $request->branch)->sum('amount');
        
        $tenantsPayments = Payments::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('branch', $request->branch)->get();
        $tenantsExpenses = Expenses::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('branch', $request->branch)->get();
        $tenantsWater = Misc::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('misc','water')->where('branch', $request->branch)->get();
        $tenantsElec = Misc::whereYear('created_at', $year)->whereMonth('created_at', $month)->where('misc','electricity')->where('branch', $request->branch)->get();

        $income = $totalPayments - $totalExpenses;
        
        return view('reports.monthly', compact('totalPayments', 'totalExpenses', 'totalWater', 'totalElec', 
                    'tenantsPayments', 'tenantsExpenses', 'tenantsWater', 'tenantsElec', 'income', 'monthName', 'year', 'branch'));
    }

    public function date (Request $request){

        $date = Carbon::parse($request->date);
        $readableDate = $date->format('F j, Y');
        $branch = $request->branch;


        $totalPayments = Payments::whereDate('created_at', $date)->where('option','Payment')->where('branch', $request->branch)->sum('amount');
        $totalExpenses = Expenses::whereDate('created_at', $date)->where('branch', $request->branch)->sum('amount');
        $totalWater = Misc::whereDate('date_paid', $date)->where('misc','water')->where('branch', $request->branch)->sum('amount');
        $totalElec = Misc::whereDate('date_paid', $date)->where('misc','electricity')->where('branch', $request->branch)->sum('amount');
        
        $tenantsPayments = Payments::whereDate('created_at', $date)->where('branch', $request->branch)->get();
        $tenantsExpenses = Expenses::whereDate('created_at', $date)->where('branch', $request->branch)->get();
        $tenantsWater = Misc::whereDate('date_paid', $date)->where('misc','water')->where('branch', $request->branch)->get();
        $tenantsElec = Misc::whereDate('date_paid', $date)->where('misc','electricity')->where('branch', $request->branch)->get();

        $income = $totalPayments - $totalExpenses;
        
        return view('reports.daily', compact('totalPayments', 'totalExpenses', 'totalWater', 'totalElec', 
                    'tenantsPayments', 'tenantsExpenses', 'tenantsWater', 'tenantsElec', 'income', 'branch', 'readableDate'));
    }
}
