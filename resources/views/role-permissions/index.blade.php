
@extends('base')

@section('content')

<h1>Permissies koppelen aan rollen</h1>

<a href="{{ route('role-permissions.create') }}" class="btn btn-success mb-3">
    + Nieuwe koppeling
</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Rol</th>
            <th>Permissie</th>
            <th>Acties</th>
        </tr>
    </thead>

    <tbody>
        @foreach($roles as $role)
            @foreach($role->permissions as $permission)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $permission->name }}</td>

                    <td>
                        <a
                            href="{{ route('role-permissions.edit', [
                                'role_id' => $role->id,
                                'permission_id' => $permission->id
                            ]) }}"
                            class="btn btn-primary"
                        >
                            Bewerken
                        </a>

                        <form
                            action="{{ route('role-permissions.destroy', [
                                'role_id' => $role->id,
                                'permission_id' => $permission->id
                            ]) }}"
                            method="POST"
                            style="display: inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Weet je zeker dat je deze koppeling wilt verwijderen?')"
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
