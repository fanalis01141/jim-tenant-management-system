<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use Carbon\Carbon;
use App\Models\Tenants;
use App\Models\Expenses;
use App\Models\Misc;


class AdminController extends Controller
{
    public function payments(){
        $tenants = Tenants::all();

        return view ('admin.payments.landing', compact('tenants'));
    }

    public function paymentsResult(Request $request){
        // Reports by date
        if ($request->type == 'byDate'){
            
            $date = Carbon::parse($request->date);
            $readableDate = $date->format('F j, Y');
            $branch = $request->branch;
    
            $totalPayments = Payments::whereDate('created_at', $date)->where('option','Payment')->where('branch', $request->branch)->sum('amount');
            $tenantsPayments = Payments::whereDate('created_at', $date)->where('branch', $request->branch)->get();
            $totalPaid = Payments::whereDate('created_at', $date)->where('option','Payment')->where('branch', $request->branch)->count();
            $totalPass = Payments::whereDate('created_at', $date)->where('option','Pass')->where('branch', $request->branch)->count();
    
            return view ('admin.payments.date', compact('totalPayments', 'tenantsPayments', 'branch', 'readableDate', 'totalPass', 'totalPaid'));
        
        }else{

            // reports by month
            $date = Carbon::parse($request->date);
            $month = $date->month;
            $year = $date->year;
            $branch = $request->branch;
            $readableDate = $date->format('F, Y');
    
            $totalPayments = Payments::whereMonth('created_at', $month)->whereYear('created_at', $year)->where('option','Payment')->where('branch', $request->branch)->sum('amount');
            $tenantsPayments = Payments::whereMonth('created_at', $month)->whereYear('created_at', $year)->where('branch', $request->branch)->orderBy('created_at','desc')->get();
            $totalPaid = Payments::whereMonth('created_at', $month)->whereYear('created_at', $year)->where('option','Payment')->where('branch', $request->branch)->count();
            $totalPass = Payments::whereMonth('created_at', $month)->whereYear('created_at', $year)->where('option','Pass')->where('branch', $request->branch)->count();
    
            return view ('admin.payments.month', compact('totalPayments', 'tenantsPayments', 'branch', 'readableDate', 'totalPass', 'totalPaid'));
        }
    }

    public function expensesLanding(){
        $tenants = Tenants::all();

        return view ('admin.expenses.landing', compact('tenants'));
    }

    public function expensesResult(Request $request){
        // Reports by date
        if ($request->type == 'byDate'){
            
            $date = Carbon::parse($request->date);
            $readableDate = $date->format('F j, Y');
            $branch = $request->branch;
    
            $totalExpenses = Expenses::whereDate('date', $date)->where('branch', $request->branch)->sum('amount');
            $expensesList = Expenses::whereDate('date', $date)->where('branch', $request->branch)->get();
            $expensesCount = Expenses::whereDate('date', $date)->where('branch', $request->branch)->count();
    
            return view ('admin.expenses.date', compact('totalExpenses', 'expensesList', 'branch', 'readableDate', 'expensesCount'));
        
        }else{ // Reports by month
            

            $date = Carbon::parse($request->date);
            $month = $date->month;
            $year = $date->year;
            $branch = $request->branch;
            $readableDate = $date->format('F, Y');
    
            $totalExpenses = Expenses::whereMonth('date', $month)->whereYear('date', $year)->where('branch', $request->branch)->sum('amount');
            $expensesList = Expenses::whereMonth('date', $month)->whereYear('date', $year)->where('branch', $request->branch)->orderBy('date','desc')->get();
            $expensesCount = Expenses::whereMonth('date', $month)->whereYear('date', $year)->where('branch', $request->branch)->count();
    
            return view ('admin.expenses.month', compact('totalExpenses', 'expensesList', 'branch', 'readableDate', 'expensesCount'));
        }
    }


    public function waterMiscLanding(){
        $tenants = Tenants::all();
        $tenantsWithWaterUtility = Tenants::where('utility', 'LIKE', '%water%')->get();

        return view ('admin.misc.waterLanding', compact('tenants','tenantsWithWaterUtility'));
    }

    public function waterMiscResult(Request $request){
        // Reports by date
        if ($request->type == 'byDate'){
            
            $date = Carbon::parse($request->date);
            $readableDate = $date->format('F j, Y');
            $branch = $request->branch;
    
            $totalWater = Misc::whereDate('date_paid', $date)->where('misc','water')->where('branch', $request->branch)->sum('amount');
            $tenantsWater = Misc::whereDate('date_paid', $date)->where('misc','water')->where('branch', $request->branch)->get();
    
            return view ('admin.misc.waterByDate', compact('totalWater', 'tenantsWater', 'branch', 'readableDate'));
        
        }else{ // Reports by month

            $date = Carbon::parse($request->date);
            $month = $date->month;
            $year = $date->year;
            $branch = $request->branch;
            $readableDate = $date->format('F, Y');
    
            $totalWater = Misc::whereMonth('date_paid', $month)->whereYear('date_paid', $year)->where('misc','water')->where('branch', $request->branch)->sum('amount');
            $tenantsWater = Misc::whereMonth('date_paid', $month)->whereYear('date_paid', $year)->where('misc','water')->where('branch', $request->branch)->get();
            
            return view ('admin.misc.waterByMonth', compact('totalWater', 'tenantsWater', 'branch', 'readableDate'));
        }
    }

    public function elecMiscLanding(){
        $tenants = Tenants::all();
        $tenantsWithElecUtility = Tenants::where('utility', 'LIKE', '%electricity%')->get();

        return view ('admin.misc.elecLanding', compact('tenants','tenantsWithElecUtility'));
    }

    public function elecMiscResult(Request $request){
        // Reports by date
        if ($request->type == 'byDate'){
            
            $date = Carbon::parse($request->date);
            $readableDate = $date->format('F j, Y');
            $branch = $request->branch;
    
            $totalElec = Misc::whereDate('date_paid', $date)->where('misc','electricity')->where('branch', $request->branch)->sum('amount');
            $tenantsElec = Misc::whereDate('date_paid', $date)->where('misc','electricity')->where('branch', $request->branch)->get();
    
            return view ('admin.misc.elecByDate', compact('totalElec', 'tenantsElec', 'branch', 'readableDate'));
        
        }else{ // Reports by month

            $date = Carbon::parse($request->date);
            $month = $date->month;
            $year = $date->year;
            $branch = $request->branch;
            $readableDate = $date->format('F, Y');
    
            $totalElec = Misc::whereMonth('date_paid', $month)->whereYear('date_paid', $year)->where('misc','electricity')->where('branch', $request->branch)->sum('amount');
            $tenantsElec = Misc::whereMonth('date_paid', $month)->whereYear('date_paid', $year)->where('misc','electricity')->where('branch', $request->branch)->get();
            
            return view ('admin.misc.elecByMonth', compact('totalElec', 'tenantsElec', 'branch', 'readableDate'));
        }
    }
}
