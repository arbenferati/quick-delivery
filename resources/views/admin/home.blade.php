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
    </div>
</div>

@endsection
