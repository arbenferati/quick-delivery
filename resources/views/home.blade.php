@extends('layouts.app')

@section('content')

@guest
    @include('layouts.partials.forms.login')
@endguest

@auth
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Commandes en cours') }}</div>

                <div class="card-body">

                    <table class="table">
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
                                <td scope="row">100</td>
                                <td>SmartTV Samsung SERIE9</td>
                                <td><span class="badge rounded-pill bg-warning">En attente de livraison</span></td>
                                <td style="text-align: right">
                                    <a name="edit-btn" id="edit-btn" class="btn btn-primary" href="" role="button">Edit</a>
                                    <a name="delete-btn" id="delete-btn" class="btn btn-danger" href="" role="button">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endauth

@endsection
