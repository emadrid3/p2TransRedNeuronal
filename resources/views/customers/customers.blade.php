@extends('layouts.app')

@section('content')
<view-customers :auth="{{$auth}}"></view-customers>
@endsection