@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-left mb-4">
        <div class="col-3">
            <a class="btn btn-sm btn-dark" href="{{ route('home') }}" role="button"><- Retour</a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Commande numéro') }} {{ $order->id }}</div>

                <div class="card-body">


                    <div class="card">
                        <div class="card-header">{{ __('Les produits') }}</div>

                        <div class="card-body">

                            @foreach ($order->products as $product)
                                <p>{{ $product->name }}</p>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
