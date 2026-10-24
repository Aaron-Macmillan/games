
@extends('base')

@section('content')

<h1>Nieuwe gebruiker-rolkoppeling</h1>

<form action="{{ route('user-roles.store') }}" method="POST">
    @csrf

    <label for="user_id">Gebruiker:</label>
    <select name="user_id" id="user_id" required>
        <option value="">-- Selecteer een gebruiker --</option>

        @foreach($users as $item)
            <option
                value="{{ $item->id }}"
                {{ old('user_id') == $item->id ? 'selected' : '' }}
            >
                {{ $item->name }} · {{ $item->email }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label for="role_id">Rol:</label>
    <select name="role_id" id="role_id" required>
        <option value="">-- Selecteer een rol --</option>

        @foreach($roles as $item)
            <option
                value="{{ $item->id }}"
                {{ old('role_id') == $item->id ? 'selected' : '' }}
            >
                {{ $item->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label for="model_type">Modeltype:</label>
    <input
        type="text"
        id="model_type"
        value="App\Models\User"
        readonly
    >

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

    <a href="{{ route('user-roles.index') }}" class="btn btn-secondary">
        Annuleren
    </a>
</form>

@endsection
