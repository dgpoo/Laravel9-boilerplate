@extends('layouts.admin')

@section('frontcontent')
<div class="row justify-content-center login-sec">
        <div class="col-md-6 login-part">
            <div class="card">
                <div class="mfWFCompCls mfWFTxtCls login-text">
                    <p>Login</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminLoginPost') }}" method="post">
                        {!! csrf_field() !!}
                        @if(\Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ \Session::get('success') }}
                            
                            </button>
                        </div>
                        @endif
                        {{ \Session::forget('success') }}
                        @if(\Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ \Session::get('error') }}
                            
                            </button>
                        </div>
                        @endif       
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="{{__('Email Address')}}" required="required">
                            @if ($errors->has('email'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}" required="required">
                            @if ($errors->has('password'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">{{__('Login')}}</button>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 right-part">
        </div>
    </div>

@endsection