@extends('layouts.app')

@section('content')

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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Livreurs engagés') }}</div>

                <div class="card-body">

                    <button id="add-deliverer-btn" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add-deliverer-modal">
                        {{ __('Engager un livreur') }}
                    </button>

                    <div class="row">
                    @foreach ($storeDeliverers as $deliverer)
                        @if ($deliverer->confirmed($deliverer, Auth::user()->store))
                            <div class="col-md-3">
                                <div class="card my-3">
                                    <div class="card-thumbnail">
                                        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" class="img-fluid" alt="thumbnail">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <a href="#" class="text-secondary">
                                                {{ $deliverer->name }}
                                            </a>
                                        </h3>
                                        <p class="card-text">
                                            {{ $deliverer->email }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modals --}}
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

{{-- End modals --}}

@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/products/modals-and-forms.js') }}"></script>
@endsection
