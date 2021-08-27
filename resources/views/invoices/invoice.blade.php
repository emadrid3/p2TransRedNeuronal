@extends('layouts.app')

@section('content')
<view-invoice :auth="{{$auth}}"></view-invoice>
@endsection