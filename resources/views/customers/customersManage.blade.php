@extends('layouts.app')

@section('content')

@if ($customer != null)
    <view-manage-customers :customerprop="{{$customer}}"></view-manage-customers>
@else
    <view-manage-customers ></view-manage-customers>
@endif
@endsection
