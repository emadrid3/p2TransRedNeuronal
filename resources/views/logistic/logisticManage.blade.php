@extends('layouts.app')

@section('content')

@if ($logistica != null)
    <view-manage-logistic :logisticaprop="{{$logistica}}"></view-manage-logistic>
@else
    <view-manage-logistic></view-manage-logistic>
@endif

@endsection