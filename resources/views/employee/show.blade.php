@extends('layouts.app')
@section('content')

<div class="container p-5 text-center">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1 class="mb-5 text-success">Single employee info</h1>
            <div class="card">
                <img src="{{ asset('image/'. $employee->image) }}" width="200" height="200" alt="img" class="rounded-circle p-3" style="margin-left:150px;">

                <div class="card-body">
                    <h4 class="card-title"><span class="text-primary">Customer Name is</span> : {{ $employee->name }}</h4>
                    <h5 class="card-title"><span class="text-primary">Customer Phone is</span> : {{ $employee->phone }}</h5>
                    <h6 class="card-title"><span class="text-primary">Customer Salary is</span> : {{ $employee->salary }}</h6>
                </div>
            </div>
            <a href="{{ route('employee.index') }}" class="btn btn-primary float-end mt-3">Back</a>
        </div>
    </div>
</div>
@endsection