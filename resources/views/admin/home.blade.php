@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des derniers inscrits') }}</div>

                <div class="card-body">

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Status</th>
                                <th style="text-align: right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @if ($user->id !== auth()->user()->id)
                                <tr>
                                    <td scope="row">{{ $user->id }}</td>
                                    <td>{{ $user->name }} <small>({{ $user->email }})</small></td>
                                    <td>
                                    @if($user->userValidated())
                                        <span class="badge rounded-pill bg-success">Confirmé</span>
                                    @else
                                        <span class="badge rounded-pill bg-warning">En attente de confirmation</span>
                                    @endif
                                    </td>
                                    <td style="text-align: right">
                                    @if($user->userValidated())
                                        <button name="delete-btn" id="delete-btn" class="btn btn-danger" role="button">Supprimer</button>
                                    @else
                                        <button name="confirm-btn" id="confirm-btn" class="btn btn-success" role="button">Confirmer</button>
                                        <button name="cancel-btn" id="cancel-btn" class="btn btn-danger" role="button">Refuser</button>
                                    @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Roles & permissions') }}</div>

                <div class="card-body">

                    <h4>Roles</h4>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th style="text-align: right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">Vendeur</td>
                                <td style="text-align: right">
                                    <a name="confirm-btn" id="confirm-btn" class="btn btn-primary" href="" role="button">Modifier</a>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">Admin</td>
                                <td style="text-align: right">
                                    <a name="confirm-btn" id="confirm-btn" class="btn btn-primary" href="" role="button">Modifier</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-grid gap-2">
                      <button type="button" name="add-role-btn" id="add-role-btn" class="btn btn-primary">Ajouter role</button>
                    </div>

                    <hr>

                    <h4>Permissions</h4>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th style="text-align: right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">Ajouter livreur</td>
                                <td style="text-align: right">
                                    <a name="confirm-btn" id="confirm-btn" class="btn btn-primary" href="" role="button">Modifier</a>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">Engager livreur</td>
                                <td style="text-align: right">
                                    <a name="confirm-btn" id="confirm-btn" class="btn btn-primary" href="" role="button">Modifier</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-grid gap-2">
                      <button type="button" name="add-role-btn" id="add-role-btn" class="btn btn-primary">Ajouter permission</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
