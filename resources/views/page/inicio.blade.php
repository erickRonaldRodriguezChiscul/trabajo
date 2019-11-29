@extends('layouts.app')
@section('recorrido')
    <li class="active">Dashboard</li>
    <li class="active">Seguimos</li>
@endsection
@section('nombre-pagina-actual','Inicio')
@section('content')
<div class="row">
    @if (auth()->user()->tipo == 1)
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $taxista }}</h3>
    
                <p>Emprendedoras</p>
            </div>
            <div class="icon">
                <i class="fa fa-male"></i>
            </div>
            <a href="{{ route('taxista') }}" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endif
    
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3>{{ $vehiculo }}</h3>

            <p>Vehiculos</p>
        </div>
        <div class="icon">
            <i class="fa fa-taxi"></i>
        </div>
        <a href="{{ route('vehiculo') }}" class="small-box-footer">Mas informacion<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3>{{ $cliente }}</h3>

            <p>Clientes</p>
        </div>
        <div class="icon">
            <i class="fa fa-street-view"></i>
        </div>
        <a href="{{ route('cliente') }}" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3>{{ $contacto }}</h3>

            <p>Contactos</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <a href="{{ route('contacto') }}" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
@endsection
