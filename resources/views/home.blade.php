@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Pedidos</div>

                    <div class="card-body">
                    <buscarpedidosid-component></buscarpedidosid-component>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Pedidos</div>

                    <div class="card-body">
                    <buscarpedidosfecha-component></buscarpedidosfecha-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection