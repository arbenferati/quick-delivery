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

<div class="container-fluid">
    <div class="row justify-content-center">
        @if (count($products) === 0)
            <div class="col-md-8">
                <div class="alert alert-info" role="alert">
                    <strong>Il n'y a pas de produits supprimés dans votre magasin !</strong>
                </div>
            </div>
        @else
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Produits supprimés') }}
                </div>
                <div class="card-body">
                    <table class="table table-sm table-responsive">
                        <thead class="thead-default">
                            <tr>
                                <th>Nom</th>
                                <th style="text-align: right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td scope="row">{{ $product->name }}</td>
                                <td style="text-align: right">
                                    <button id="delete-btn"
                                            class="btn btn-sm btn-dark"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmation-modal"
                                            onclick="confirmDialog(
                                                'Restauration du produit {{ $product->name }}',
                                                'Vous êtes sur le point de restaurer le produit {{ $product->name }}. Voulez-vous coninuer ?',
                                                '{{ route('restore-product', $product->id) }}'
                                                )">
                                        Restaurer
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- Modals --}}
            {{-- Confirmation delete product modal --}}
                <div class="modal fade" id="confirmation-modal" tabindex="-1" aria-labelledby="confirmation-modal-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmation-modal-label"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p id="confirmation-body-text"></p>
                                <div class="row justify-content">
                                    <div class="col-6">
                                        <a name="confirmation-btn" id="confirmation-btn" class="btn btn-primary" href="">
                                            {{ __('Confirmer') }}
                                        </a>
                                    </div>
                                    <div class="col-6" style="text-align: right">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End confirmation delete product modal --}}
        {{-- End modals --}}

        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/products/modals-and-forms.js') }}"></script>
@endsection
