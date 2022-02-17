@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{__('Add New Translation')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('translation') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('translate.store') }}" method="POST">
        @csrf
        
        <div class="row mb-3">
            <label for="key" class="col-md-4 col-form-label text-md-end">{{ __('Select language') }}</label>

            <div class="col-md-6">
                <select name="language" id="language" class="form-select" required>
                    @foreach($language as $lang)
                    <option value="{{$lang->slug}}">{{$lang->slug}}</option>
                    @endforeach 
                </select>
                @error('key')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="key" class="col-md-4 col-form-label text-md-end">{{ __('Default text') }}</label>

            <div class="col-md-6">
                <input id="key" type="text" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required>

                @error('key')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="value" class="col-md-4 col-form-label text-md-end">{{ __('Translated text') }}</label>

            <div class="col-md-6">
                <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required>

                @error('value')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
                        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{__('Add')}}</button>
        </div>

    </form>
@endsection