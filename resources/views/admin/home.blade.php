@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Commandes en cours') }}</div>

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
                            <tr>
                                <td scope="row">101</td>
                                <td>John Doe <small>(john@doe.com)</small></td>
                                <td><span class="badge rounded-pill bg-warning">En attente de confirmation</span></td>
                                <td style="text-align: right">
                                    <a name="confirm-btn" id="confirm-btn" class="btn btn-success" href="" role="button">Confirmer</a>
                                    <a name="cancel-btn" id="cancel-btn" class="btn btn-danger" href="" role="button">Refuser</a>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">100</td>
                                <td>Johnny Depp <small>(johnny@depp.com)</small></td>
                                <td><span class="badge rounded-pill bg-success">Confirmé</span></td>
                                <td style="text-align: right">
                                    <a name="delete-btn" id="delete-btn" class="btn btn-danger" href="" role="button">Supprimer</a>
                                </td>
                            </tr>
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
