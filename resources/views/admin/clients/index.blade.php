@extends('layouts.auth-admin.app')

@section('content')
<div>

    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1>Clients</h1>
            <p class="subtitle">Liste complète des clients enregistrés</p>
        </div>
        <div>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                Ajouter un client
            </a>
        </div>
    </div>

    <!-- Table Clients -->
    <div class="table-responsive">
        <table class="table-product">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Client</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td data-label="N°">{{ $loop->iteration }}</td>
                    <td data-label="Client">{{ $client->id }}</td>
                    <td data-label="Nom">{{ $client->firstname }} {{ $client->lastname }}</td>
                    <td data-label="Email">{{ $client->email }}</td>
                    <td data-label="Date inscription">{{ $client->created_at->format('d/m/Y') }}</td>
                    <td data-label="Actions">
                        <div class="actions-buttons">
                            <a href="{{ route('admin.clients.show', $client->id) }}" class="btn-action btn-view">
                            👁️
                        </a>
                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn-action btn-edit">
                            ✏️
                        </a></tr>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        Aucun client trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection