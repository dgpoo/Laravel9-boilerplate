@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{__('Edit translation')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
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

    <form action="{{ route('translate.update', $translate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row mb-3">
            <label for="key" class="col-md-4 col-form-label text-md-end">{{ __('Select language') }}</label>

            <div class="col-md-6">
                    <input id="language" type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ $translate->language }}" required readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="key" class="col-md-4 col-form-label text-md-end">{{ __('Default text') }}</label>

            <div class="col-md-6">
                <input id="key" type="text" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ $translate->key }}" required readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="value" class="col-md-4 col-form-label text-md-end">{{ __('Translated text') }}</label>

            <div class="col-md-6">
                <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ $translate->value }}" required>
            </div>
        </div>
                        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        </div>


    </form>
@endsection