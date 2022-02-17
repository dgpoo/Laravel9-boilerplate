@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{__('Edit Translation')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('languages') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>

    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{__('Whoops!')}}</strong>{{__('There were some problems with your input.')}}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('language.updatetranslation', $language->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
        @foreach($translate as $tr)
            <div class="col-md-4">
                <label for="language" class="col-form-label text-md">{{ $tr->key }}</label>
                <input id="language" type="hidden" class="form-control" name="key[]" value="{{ $tr->key }}">
                <div class="clone_input">
                <input id="language" type="text" class="align-bottom form-control" name="value[]" value="{{ $tr->value }}">
                </div>
            </div>
        @endforeach
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
        </div>
    </form> 
@endsection