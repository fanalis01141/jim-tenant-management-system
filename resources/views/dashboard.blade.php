@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h2 class="card-title text-black">Welcome to your dashboard, <b class="text-primary">{{Auth::user()->name}}</b> 🎉</h2>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-store-alt bx-md' style="color:#379bdd"></i>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Number of Tenants</span>
            <h3 class="card-title mb-2">{{$tenants->count()}}</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-user-circle bx-md' style="color:#696CFF"></i>              
              </div>
            </div>
            <span>Number of Users</span>
            <h3 class="card-title text-nowrap mb-1">{{$users}}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-12 d-flex justify-content-between p-1">
          <h5 class="card-header m-0 me-2 pb-3">Tenants Record</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Branch</th>
                  <th>Phone Number</th>
                  <th>Start Date & Time</th>

                </tr>
              </thead>
              <tbody>

                    @foreach ($tenants as $tenant)
                    <tr>
                        <td>{{ ucwords($tenant->full_name) }}</td>
                        <td>{{$tenant->branch}}</td>
                        <td>{{$tenant->phone_number}}</td>
                        <td>{{\Carbon\Carbon::parse($tenant->start_date)->format('F j, Y')}}, at {{\Carbon\Carbon::parse($tenant->start_time)->format('g:ia')}}</td>
                    


                    </tr>
                    @endforeach                               

              </tbody>
            </table>
        </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-arrow-to-left bx-md' style="color: #37dd61"></i>
              </div>
            </div>
            <span class="d-block mb-1">Month Cash-in</span>
            <h3 class="card-title text-nowrap mb-2">P 12345.00</h3>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-archive-out bx-md' style="color:#e93b3b"></i>              
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Month Cash-out</span>
            <h3 class="card-title mb-2">P 14,857</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
