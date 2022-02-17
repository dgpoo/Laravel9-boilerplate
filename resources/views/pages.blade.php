@extends('layouts.app')
<title>{{ $page->name }}</title>
@section('content')
<div class="main-content">{!! ($page->description) !!}</div>
@endsection