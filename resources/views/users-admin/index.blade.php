@extends('layouts.admin')

@section('title', 'Użytkownicy')

@section('content')
    <h1>Użytkownicy</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Imię</th>
                <th>E-mail</th>
                <th>Rola</th>
                <th></th>
            </tr>
        </thead>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles[0]->name }}</td>
            <td class="text-right">
                <a class="btn btn-info" href="{{ route('users-admin.edit', $user) }}">Edytuj</a>
                <form method="POST" action="{{ route('users-admin.destroy', $user) }}" class="admin-panel-delete-form">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" data-toggle="confirmation">Usuń</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-confirmation/bootstrap-confirmation.js') }}"></script>
    <script>
        $( function() {
            $('[data-toggle="confirmation"]').confirmation({
                title: "Czy na pewno usunąć?",
                btnOkLabel: "Tak",
                btnCancelLabel: "Nie"
            });
        })
    </script>
@endsection