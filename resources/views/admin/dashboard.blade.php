@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-100">
			<div class="card-body">
				<div class="mr-5 h2">Users<span class="pull-right">{{$users}}</span></div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="{{route('users')}}">
				<span class="float-left">View Details</span>
			</a>
		</div>
	</div>

	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-100">
			<div class="card-body">
				<div class="mr-5 h2">Pages<span class="pull-right">{{$pages}}</span></div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="{{route('pages.index')}}">
				<span class="float-left">View Details</span>
			</a>
		</div>
	</div>
</div>
@endsection
