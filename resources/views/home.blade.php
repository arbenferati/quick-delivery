@extends('layouts.app')

@section('content')

@guest
    @include('layouts.partials.forms.login')
@endguest

@auth

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

        @if(!auth()->user()->userValidated())
            <div class="col-md-8">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Bienvenue {{ auth()->user()->name }}</h4>
                    <p>Votre magasin "{{ auth()->user()->store->name }}" a bien été enregistrer sur notre base de données, mais il faut attendre qu'un administrateur confirme votre inscription.</p>
                    <hr>
                    <p class="mb-0">Merci de votre compréhension.</p>
                </div>
            </div>
        @else

        {{-- Orders section --}}
            <div class="col-md-6">
                @foreach ($status as $s)
                <div class="card mb-4">
                    <div class="card-header">Commandes : {{ $s->name }}</div>

                    <div class="card-body">

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="text-align: right">Statut</th>
                                    <th style="text-align: right; width: 25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @if ($order->status->id == $s->id)
                                        <tr style="vertical-align: center">
                                            <td class="align-middle"><a href="{{ route('show-order', $order->id) }}">Commande N#{{ $order->id }}</a></td>
                                            <td class="align-middle" style="text-align: right">
                                                @switch($s->name)
                                                    @case('En préparation')
                                                        <span class="badge rounded-pill bg-warning">{{ $s->name }}</span>
                                                        @break
                                                    @case('Prête')
                                                        <span class="badge rounded-pill bg-success">{{ $s->name }}</span>
                                                        @break
                                                    @case('Annulée')
                                                        <span class="badge rounded-pill bg-danger">{{ $s->name }}</span>
                                                        @break
                                                    @default
                                                        <span class="badge rounded-pill bg-dark">{{ $s->name }}</span>
                                                @endswitch
                                            </td>
                                            <td class="align-middle" style="text-align: right">
                                                @switch($s->name)
                                                    @case('En préparation')
                                                        <a style="color: white" class="btn btn-sm btn-success" href="{{ route('update-order-status', [$order->id, 3]) }}" role="button">Prête</a>
                                                        <button type="button"
                                                                name="cancel-order-btn"
                                                                class="btn btn-sm btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmation-modal"
                                                                onclick="confirmDialog(
                                                                    'Annulation de commande.',
                                                                    'Êtes-vous certain que vous voulez annulé cette commande ?',
                                                                    '{{ route('cancel-order', $order->id) }}'
                                                                    )">
                                                                Annuler
                                                        </button>
                                                        @break
                                                    @case('Prête')
                                                        <a style="color: white" class="btn btn-sm btn-warning" href="{{ route('update-order-status', [$order->id, 2]) }}" role="button">Remettre en préparation</a>
                                                        @break
                                                    @case('Annulée')
                                                        <button type="button"
                                                                name="cancel-order-btn"
                                                                class="btn btn-sm btn-dark"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmation-modal"
                                                                onclick="confirmDialog(
                                                                    'Archiver commande.',
                                                                    'Êtes-vous certain que vous voulez archiver cette commande ? Elle ne sera plus visible !',
                                                                    '#'
                                                                    )">
                                                                Archiver
                                                        </button>
                                                        @break
                                                    @default
                                                        <a style="color: white" class="btn btn-sm btn-warning" href="{{ route('update-order-status', [$order->id, 2]) }}" role="button">En préparation</a>
                                                        <button type="button"
                                                                name="cancel-order-btn"
                                                                class="btn btn-sm btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmation-modal"
                                                                onclick="confirmDialog(
                                                                    'Annulation de commande.',
                                                                    'Êtes-vous certain que vous voulez annulé cette commande ?',
                                                                    '{{ route('cancel-order', $order->id) }}'
                                                                    )">
                                                                Annuler
                                                        </button>

                                                @endswitch
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @endforeach
            </div>

        {{-- End orders section --}}

        {{-- Product section --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Produits') }}</div>

                    <div class="card-body">

                        @if (count($products) == 0)
                            <div class="alert alert-info" role="alert">
                                <strong>Il n'y a pas de produits dans votre magasin !</strong>
                            </div>
                        @else
                        <table class="table table-sm">
                            <thead>
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
                                        <button id="edit-btn" class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-modal"
                                                onclick="editProduct('{{ route('edit-product', $product->id) }}', {{ $product->toJson()}})">
                                            Modifier
                                        </button>
                                        <button id="delete-btn"
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmation-modal"
                                                onclick="confirmDialog(
                                                    'Suppression du produit {{ $product->name }}',
                                                    'Êtes-vous certain que vous voulez supprimer ce produit ?',
                                                    '{{ route('delete-product', $product->id) }}'
                                                    )">
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif



                        <div class="row justify-content">
                            <div class="col-6">
                                <a name="deleted-products-btn" id="deleted-products-btn" class="btn btn-sm btn-dark" href="{{ route('deleted-products') }}">
                                    {{ __('Voir produits supprimés') }}
                                </a>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <button id="add-product-btn"
                                        class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#add-product-modal">
                                    {{ __('Ajouter un produit') }}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        {{-- End porducts section --}}

        {{-- Modals --}}
            {{-- Edit product modal --}}
                <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit-modal-label"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="edit-product-form" id="edit-product-form" action="">
                                @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                                        <div class="col-md-6">
                                            <input id="edit-product-name" type="text" class="form-control" name="name" value="" required>
                                        </div>
                                    </div>

                                    <div class="row justify-content">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Confirmer') }}
                                            </button>
                                        </div>
                                        <div class="col-6" style="text-align: right">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End edit product modal --}}

            {{-- Add product modal --}}
                <div class="modal fade" id="add-product-modal" tabindex="-1" aria-labelledby="add-product-modal-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-product-modal-label">Ajouter une nouveau produit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="add-product-form" id="add-product-form" action="{{ route('add-product') }}">
                                @csrf
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                                        <div class="col-md-6">
                                            <input id="add-product-name" type="text" class="form-control" name="name" value="" required>
                                        </div>
                                    </div>

                                    <div class="row justify-content">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Confirmer') }}
                                            </button>
                                        </div>
                                        <div class="col-6" style="text-align: right">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End add modal --}}

            {{-- Add deliverer modal --}}
                <div class="modal fade" id="add-deliverer-modal" tabindex="-1" aria-labelledby="add-deliverer-modal-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-deliverer-modal-label">Engager un nouveau livreur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="add-deliverer-form" id="add-deliverer-form" action="{{ route('add-deliverer') }}">
                                @csrf
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                                        <div class="col-md-6">
                                            <input id="add-deliverer-name" type="text" class="form-control" name="name" value="" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                        <div class="col-md-6">
                                            <input id="add-deliverer-email" type="email" class="form-control" name="email" value="" required>
                                        </div>
                                    </div>

                                    <div class="row justify-content">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Confirmer') }}
                                            </button>
                                        </div>
                                        <div class="col-6" style="text-align: right">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End add modal --}}

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
@endauth

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/products/modals-and-forms.js') }}"></script>
@endsection
