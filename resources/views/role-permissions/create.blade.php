
@extends('base')

@section('content')

<h1>Nieuwe koppeling</h1>

<form action="{{ route('role-permissions.store') }}" method="POST">
    @csrf

    <label for="role_id">Rol:</label>
    <select name="role_id" id="role_id" required>
        <option value="">-- Selecteer een rol --</option>

        @foreach($roles as $role)
            <option
                value="{{ $role->id }}"
                {{ old('role_id') == $role->id ? 'selected' : '' }}
            >
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label for="permission_id">Permissie:</label>
    <select name="permission_id" id="permission_id" required>
        <option value="">-- Selecteer een permissie --</option>

        @foreach($permissions as $permission)
            <option
                value="{{ $permission->id }}"
                {{ old('permission_id') == $permission->id ? 'selected' : '' }}
            >
                {{ $permission->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <button type="submit" class="btn btn-success">
        Koppeling opslaan
    </button>

    <a href="{{ route('role-permissions.index') }}" class="btn btn-secondary">
        Annuleren
    </a>
</form>

@endsection
