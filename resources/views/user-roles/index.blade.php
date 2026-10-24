
@extends('base')

@section('content')

<h1>Gebruikers koppelen aan rollen</h1>

<a href="{{ route('user-roles.create') }}" class="btn btn-success mb-3">
    + Nieuwe koppeling
</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Gebruiker</th>
            <th>E-mail</th>
            <th>Rol</th>
            <th>Acties</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
            @foreach($user->roles as $role)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $role->name }}</td>

                    <td>
                        <a
                            href="{{ route('user-roles.edit', [
                                'user_id' => $user->id,
                                'role_id' => $role->id
                            ]) }}"
                            class="btn btn-primary"
                        >
                            Bewerken
                        </a>

                        <form
                            action="{{ route('user-roles.destroy', [
                                'user_id' => $user->id,
                                'role_id' => $role->id
                            ]) }}"
                            method="POST"
                            style="display: inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Weet je zeker dat je deze gebruiker-rolkoppeling wilt verwijderen?')"
                            >
                                Ontkoppelen
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

@endsection
