@extends('layouts.admin')

@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>{{__('Pages')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pages.create') }}" title="Create a Page"> <i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg" id="table_pages">
        <thead>
        <tr>
            <th>{{__('Number')}}</th>
            <th>{{__('Title')}}</th>
            <th width="280px">{{__('Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
        
            <tr>
                <td></td>
                <td>{{ $page->name }}</td>
                <td>
                        <a href="/{{$page->slug}}">
                            <i class="fas fa-eye  fa-lg"></i>
                        </a>
                        <a href="{{ route('pages.edit', $page->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>
                        
                        
                        <a class="border border-light bg-transparent deletepage" data-id="{{$page->id}}" href="#">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </a>
                   
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
@endsection
