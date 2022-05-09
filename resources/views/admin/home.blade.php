@extends('layouts.app')

@section('content')

<div class="container-fluid">
    @if(session()->has('success'))

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        </div>
    </div>

    @endif
    <div class="row justify-content-center">

    </div>

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
                                        <button name="disable-user-btn" class="btn btn-warning btn-sm" onclick="confirmation('{{ route('disable-user', $user->id) }}', 'Vous êtes sur le point de désactiver cet utilisateur, continuer?');"role="button">Désactiver</button>
                                        <button name="delete-btn" class="btn btn-danger btn-sm" onclick="confirmation('{{ route('delete-user', $user->id) }}', 'Voulez-vous vraiment supprimer cet utilisateurs?');" role="button">Supprimer</button>
                                    @else
                                    <button name="enable-user-btn" class="btn btn-primary btn-sm" onclick="confirmation('{{ route('enable-user', $user->id) }}', 'Vous êtes sur le point d\'accepter cet utilisateur, continuer?');"role="button">Activer</button>
                                    <button name="delete-user-btn" class="btn btn-danger btn-sm" onclick="confirmation('{{ route('delete-user', $user->id) }}', 'Voulez-vous vraiment refuser cet utilisateurs?');" role="button">Supprimer</button>
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
                            @foreach ($roles as $role)
                            <tr>
                                <td scope="row">{{ $role->name }}</td>
                                <td style="text-align: right">
                                    <button name="confirm-btn" id="confirm-btn" class="btn btn-primary btn-sm" role="button">Modifier</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-grid gap-2">
                      <button type="button" name="add-role-btn" id="add-role-btn" class="btn btn-primary btn-sm">Ajouter role</button>
                    </div>

                    <hr>

                    <h4>Permissions</h4>

                    @if ($permissions->count() > 0)
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
                                        <a name="confirm-btn" id="confirm-btn" class="btn btn-primary btn-sm" href="" role="button">Modifier</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>Il n'y pas encore de permissions. Ajoutez-en en utilisant le bouton ci-dessous.</p>
                    @endif


                    <div class="d-grid gap-2">
                      <button type="button" name="add-role-btn" id="add-role-btn" class="btn btn-primary btn-sm">Ajouter permission</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    function confirmation(link, msg) {
        var z = confirm(msg);
        if (z == true) {
            location.href = link;
        }
    }
</script>
@endsection