@extends('layouts.app')
@section('content')
<div class="container p-5 text-center">
    <h2 class="text-center p-3">Employee Table</h2>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congrats!</strong> {{ session()->get('success') }}
        @php
        session()->forget('success');
        @endphp
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{route('employee.create')}}" class="btn btn-info float-end mb-3">Add Employee</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SI.</th>
                <th>Employee Name</th>
                <th>Phone</th>
                <th>Salary</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1
            @endphp
            @foreach ( $allEmployees as $index => $employee )
            <tr>
                <td>{{ $i ++ }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->salary }}</td>
                <td><img src="{{ asset('image/'.$employee->image) }}" width="70px" height="70px" alt="image"></td>
                <td>
                    <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-success">View</a>
                    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- {!! $allEmployees->links() !!} -->
    {!! $allEmployees->withQueryString()->links('pagination::bootstrap-5') !!}
</div>

@endsection