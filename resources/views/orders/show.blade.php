@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-left mb-4">
        <div class="col-3">
            <a class="btn btn-sm btn-dark" href="{{ route('home') }}" role="button"><- Retour</a>
        </div>
    </div>
</div>


@if(session()->has('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Commande numéro') }} {{ $order->id }}</div>

                <div class="card-body">

                    <div class="mb-3">
                        @if ($order->order_status_id == 4)
                            <label for="status_id" class="form-label">État de la commande</label>
                            <select class="form-select" name="status_id" id="status_id" disabled>

                            </select>
                        @else
                        <label for="status_id" class="form-label">État de la commande</label>
                        <form action="{{ route('update-status') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="visually-hidden" for="orderId">OrderId</label>
                                <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
                            </div>
                            <select class="form-select mb-2" name="status_id" id="status_id">
                                @foreach ($orderStatus as $status)
                                    <option value="{{ $status->id }}" @if($status->id == $order->order_status_id) selected @endif>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="d-grid gap-2">
                              <button type="submit" name="confirm_btn" id="confirm_btn" class="btn  btn-primary">Confirmer</button>
                            </div>
                        </form>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-header">{{ __('Les produits') }}</div>

                        <div class="card-body">

                            <table class="table table-sm table-responsive">
                                <thead class="thead-default">
                                    <tr>
                                        <th>Nom</th>
                                        <th style="text-align: right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                        <tr>
                                            <td scope="row">{{ $product->name }}</td>
                                            <td style="text-align: right"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
