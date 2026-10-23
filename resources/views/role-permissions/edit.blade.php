
@extends('base')

@section('content')

<h1>Koppeling bewerken</h1>

<form
    action="{{ route('role-permissions.update', [
        'role_id' => $role->id,
        'permission_id' => $permission->id
    ]) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <label for="role_id">Rol:</label>
    <select name="role_id" id="role_id" required>
        @foreach($roles as $item)
            <option
                value="{{ $item->id }}"
                {{ old('role_id', $role->id) == $item->id ? 'selected' : '' }}
            >
                {{ $item->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label for="permission_id">Permissie:</label>
    <select name="permission_id" id="permission_id" required>
        @foreach($permissions as $item)
            <option
                value="{{ $item->id }}"
                {{ old('permission_id', $permission->id) == $item->id ? 'selected' : '' }}
            >
                {{ $item->name }}
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

    <button type="submit" class="btn btn-primary">
        Koppeling opslaan
    </button>

    <a href="{{ route('role-permissions.index') }}" class="btn btn-secondary">
        Annuleren
    </a>
</form>

@endsection
