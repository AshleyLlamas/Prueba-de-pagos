@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Modificar pago</h1>
@stop

@section('content')
    <livewire:admin.invoices.edit :invoice="$invoice" />
@stop

@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
