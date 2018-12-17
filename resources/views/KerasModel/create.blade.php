
@extends('layouts.index') 
@section('CoreContent')



<form  action="{{route('KerasModel.store') }}" id="frmKerasModel" method="post">

	@include('KerasModel.form')
@endsection
 
@section('ScriptContent')
	@include('KerasModel.JtableLayer')
@endsection