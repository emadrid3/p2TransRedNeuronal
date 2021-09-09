@extends('layouts.app')

@section('content')
<view-logistic :auth="{{$auth}}" :page="{{$page}}"></view-logistic>
@endsection