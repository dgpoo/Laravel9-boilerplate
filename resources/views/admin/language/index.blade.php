@extends('layouts.admin')

@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>{{__('Languages')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('language.create') }}" title="Create a User"> <i class="fas fa-plus-circle"></i>
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
            <th>{{__('Language')}}</th>
            <th>{{__('Slug')}}</th>
            <th width="280px">{{__('Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($language as $lang) 
            <tr>
                <td></td>
                <td>{{ $lang->language }}</td>
                <td>{{ $lang->slug }}</td>
                <td>

                    <!-- <form action="{{ route('language.destroy', $lang->id) }}" method="POST">
                        
                    
                        @csrf
                        @method('DELETE')
                        
                    </form> -->
                    <a href="{{ route('language.edit', $lang->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>
                    </a>
                    <a href="#" class="border border-light delete_language bg-transparent" data-id="{{$lang->id}}">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
@endsection
