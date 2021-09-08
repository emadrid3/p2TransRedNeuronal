@extends('layouts.app')

@section('content')

@if ($logistica != null)
    <view-manage-logistic :logisticaprop="{{$logistica}}" :page="{{$page}}"></view-manage-logistic>
@else
    <view-manage-logistic></view-manage-logistic>
@endif

@endsection