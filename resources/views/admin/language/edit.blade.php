@extends('layouts.admin')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{__('Edit Language')}}</h2>
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

    <form action="{{ route('language.update', $language->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <label for="language" class="col-md-4 col-form-label text-md-end">{{ __('Language name') }}</label>
            <div class="col-md-6">
                <input id="language" type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ $language->language }}" required autocomplete="language" autofocus>
                @error('language')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="slug" class="col-md-4 col-form-label text-md-end">{{ __('Slug name') }}</label>
            <div class="col-md-6">
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $language->slug }}" required autocomplete="slug" autofocus>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="flag" class="col-md-4 col-form-label text-md-end">{{ __('Flag Image') }}</label>

            <div class="col-md-6">
                <input id="flag" type="file" class="form-control @error('flag') is-invalid @enderror" name="flag" value="{{ $language->flag }}" required autocomplete="flag">

                @error('flag')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
        </div>
    </form>
@endsection