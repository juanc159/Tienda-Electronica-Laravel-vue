@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Productos</div>

                    <div class="card-body">
                        <producto-component></producto-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection