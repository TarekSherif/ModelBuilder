
@extends('layouts.index') 
@section('CoreContent')



<form  action="{{ route('KerasModel.update',[$KerasModel->ModelID]) }}" id="frmKerasModel" method="post">
	@method('PUT')
	@include('KerasModel.form')
@endsection
 
@section('ScriptContent')
	@include('KerasModel.JtableLayer')
@endsection