
@extends('base')

@section('content')

<h1>Rollen</h1>

<a href="{{ route('roles.create') }}" class="btn btn-success mb-3">
    + Nieuwe rol
</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Guard</th>
            <th>Acties</th>
        </tr>
    </thead>

    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->guard_name }}</td>

            <td>
                <a href="{{ route('roles.edit', $role->id) }}"
                   class="btn btn-primary">
                    Bewerken
                </a>

                <form
                    action="{{ route('roles.destroy', $role->id) }}"
                    method="POST"
                    style="display: inline;"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Weet je zeker dat je deze rol wilt verwijderen?')">
                        Verwijderen
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
