@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pedidos</div>

                    <div class="card-body">
                        <pedido-component></pedido-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection