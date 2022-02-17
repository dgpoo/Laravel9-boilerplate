@extends('layouts.admin')
@section('content')
<!doctype html>
<html lang="en">
    <head>
    <title> Create Post - CKEditor Example </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    </head>
    <body>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('General Setting') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_setting') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <img src="{{ asset('img/profile/' . $setting->image) }}" hight=100 width=150>
                               
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('img/profile/' . $setting->favicon) }}" hight=50 width=50>
                               
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label text-md-end">{{ __('Choose Logo') }}</label>
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ $setting->image }}"  autocomplete="logo">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-md-4">
                                <label for="name" class="col-form-label text-md-end">{{ __('Choose favicon') }}</label>
                                <input id="favicon" type="file" class="form-control @error('favicon') is-invalid @enderror" name="favicon" value="{{ $setting->favicon }}"  autocomplete="favicon">
                                
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="sitename" type="text" class="form-control @error('sitename') is-invalid @enderror" name="sitename" value="{{$setting->sitename}}" required placeholder="Enter site name" autocomplete="sitename" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 offset">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>

</html>
@endsection
