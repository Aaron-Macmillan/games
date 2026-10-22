
@extends('base')

@section('content')

<h1>Permissies</h1>

<a href="{{ route('permissions.create') }}" class="btn btn-success mb-3">
    + Nieuwe permissie
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
        @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->guard_name }}</td>

            <td>
                <a href="{{ route('permissions.edit', $permission->id) }}"
                   class="btn btn-primary">
                    Bewerken
                </a>

                <form
                    action="{{ route('permissions.destroy', $permission->id) }}"
                    method="POST"
                    style="display: inline;"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Weet je zeker dat je deze permissie wilt verwijderen?')">
                        Verwijderen
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
