@extends('layouts.app')
@section('recorrido')
    <li class="active">mapa</li>
@endsection
@section('styleAgregado')
    <style>
    #dvMap{
    display: block;
    width: 95%;
    height: 350px;
    margin: 0 auto;
    -moz-box-shadow: 0px 5px 20px #ccc;
    -webkit-box-shadow: 0px 5px 20px #ccc;
    box-shadow: 0px 5px 20px #ccc;
    }
    #dvMap.large{
    height:500px;
    }

    .overlay{
    display:block;
    text-align:center;
    color:#fff;
    font-size:60px;
    line-height:80px;
    opacity:0.8;
    background:#4477aa;
    border:solid 3px #336699;
    border-radius:4px;
    box-shadow:2px 2px 10px #333;
    text-shadow:1px 1px 1px #666;
    padding:0 4px;
    }

    .overlay_arrow{
    left:50%;
    margin-left:-16px;
    width:0;
    height:0;
    position:absolute;
    }
    .overlay_arrow.above{
    bottom:-15px;
    border-left:16px solid transparent;
    border-right:16px solid transparent;
    border-top:16px solid #336699;
    }
    .overlay_arrow.below{
    top:-15px;
    border-left:16px solid transparent;
    border-right:16px solid transparent;
    border-bottom:16px solid #336699;
    }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAN8qPkPvqUT2X5vcaB_RPxZIfuHYXX294"></script>
    <script src="{{ asset('js/mapa/gmaps.min.js') }}"></script>
@endsection
@section('nombre-pagina-actual','mapa')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div id="dvMap">
        </div>
    </div>
</div>
@endsection
@section('scriptAgregado')
    <script src="{{ asset('js/mapa/mapa.js') }}"></script>
@endsection