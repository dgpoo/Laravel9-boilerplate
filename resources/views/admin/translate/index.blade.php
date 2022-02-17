@extends('layouts.admin')

@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>{{__('Translation')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('translate.create') }}" title="Create a User"> <i class="fas fa-plus-circle"></i></a>
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
            <th>{{__('Language')}}</th>
            <th>{{__('Key')}}</th>
            <th>{{__('Value')}}</th>
            <th width="280px">{{__('Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($translate as $data) 
            <tr>
                <td></td>
                <td>{{ $data->language }}</td>
                <td>{{ $data->key }}</td>
                <td>{{$data->value}}</td>
                <td>
                    <a href="{{ route('translate.edit', $data->id) }}">
                        <i class="fas fa-edit  fa-lg"></i>
                    </a>
                    <a class="border border-light bg-transparent delete_translate" data-id="{{$data->id}}" href="#"> <i class="fas fa-trash fa-lg text-danger"></i>
                    </a>
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    
    
@endsection
