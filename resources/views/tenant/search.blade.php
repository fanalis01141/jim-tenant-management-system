@extends('layouts/contentNavbarLayout')

@section('title', 'Add New Tenant - ')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="row">

        <div class="card">
            <div class="col-md-8">
                
                <div class="card-header">
                    <form action="{{ route('tenants.search') }}" method="GET">
                        <label for="tenant-name" class="">Search name for tenant</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Enter your search query">
                            <button type="submit" class="btn btn-success text-dark">Search</button>
                        </div>

                    </form>
                </div>

                <div class="card-body">

                    @if($results->count() > 0)
                        <ul>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto; height: 400px;">
                                <table class="table table-hover table-borderless">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Branch</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        @foreach ($results as $results)
                                        <tr>
                                            <td>{{ ucwords($results->full_name) }}                                        </td>
                                            <td>{{$results->branch}}</td>
                                            <td><a href="#" class="btn btn-primary"><i class="bx bx-edit-alt me-2"></i> Edit Details</a></td>
                                        </tr>
                                        @endforeach                               
                                  </tbody>
                                </table>
                            </div>
                        </ul>
                    @else
                        <ul>
                            <p>Or you can check this below:</p>
                            @foreach($users as $result)
                                <li>{{ $result->full_name }}</li>
                                
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection