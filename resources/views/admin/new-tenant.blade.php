@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Add New Tenant Information</h1>

    <div class="container">
        <div class="col-md-12">
            <form method="POST" action="{{route('tenants.store')}}">
                @csrf
                <input type="text" name="tenant-name" id="tenant-name" class="form-control" placeholder="Tenant name" required>
                <button type="submit" class="btn btn-primary mt-3">Add Tenant </button>\
            </form>
        </div>
    </div>
</div>

@endsection

