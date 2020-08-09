
@extends('layouts.index') 
@section('CoreContent')



<form  action="{{ route('DS.update',[$DS->DSID]) }}" id="frmDS" method="post">
	@method('PUT')
	@include('DS.form')
@endsection
 
@section('ScriptContent')
	@include('DS.JtableLayer')
@endsection