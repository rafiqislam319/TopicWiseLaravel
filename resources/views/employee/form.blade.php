@extends('layouts.app')
@section('content')

<div class="container p-5">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h2 class="text-center">Employee Form</h2>
            <a href="{{ route('employee.index') }}" class="btn btn-primary float-end mb-3">Back</a>
            <!-- <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data"> -->
            <form action="{{ !empty($employee) ? route('employee.update', $employee->id) : route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- @method('POST') -->
                @if (!empty($employee))
                @method('PUT')
                @endif
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ !empty($employee) ? $employee->name : old('name') }}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="{{ !empty($employee) ? $employee->phone : old('phone') }}">
                    @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="text" class="form-control" id="salary" placeholder="Enter salary" name="salary" value="{{ !empty($employee) ? $employee->salary : old('salary') }}">
                    @if ($errors->has('salary'))
                    <span class="text-danger">{{ $errors->first('salary') }}</span>
                    @endif
                </div>


                @if(!empty($employee))
                <div class="mb-3">
                    <label for="image" class="form-label">Old Image:</label>

                    <img src="{{ asset('image/'.$employee->image) }}" width="100px">

                </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection