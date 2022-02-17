@extends('layouts.admin')

@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>{{__('Users')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}" title="Create a User"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg" id="table_users">
        <thead>
        <tr>
            <th>{{__('Number')}}</th>
            <th>{{__('Profile Image')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Email')}}</th>
            <th>{{__('Status')}}</th>
            <th width="280px">{{__('Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user) 
            <tr>
                <td></td>
                <td><img src="{{ asset('img/profile/' . $user->image) }}" hight=50 width=50></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-on="Active" data-off="Disable"  data-toggle="toggle" {{ $user->status ? 'checked' : '' }}>
                 </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">
                        <i class="fas fa-edit  fa-lg"></i>
                    </a>
                    
                    <a class="delete_user border border-light bg-transparent" data-id="{{$user->id}}" href="#">
                        <i class="fas fa-trash fa-lg text-danger"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
@endsection
