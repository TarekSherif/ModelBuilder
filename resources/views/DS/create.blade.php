
@extends('layouts.index') 
@section('CoreContent')



<form  action="{{route('DS.store') }}" id="frmDS" method="post">

	@include('DS.form')
@endsection
 
@section('ScriptContent')
	@include('DS.JtableLayer')
@endsection