
@extends('base')

@section('content')

<h1>Permissie bewerken</h1>

<form action="{{ route('permissions.update', $permission->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Naam:</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ $permission->name }}"
        required
    >

    <br><br>

    <label for="guard_name">Guard:</label>
    <input
        type="text"
        id="guard_name"
        value="{{ $permission->guard_name }}"
        readonly
    >

    <br><br>

    <button type="submit" class="btn btn-primary">
        Wijzigingen opslaan
    </button>

    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
        Annuleren
    </a>
</form>

@endsection
