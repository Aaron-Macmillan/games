
@extends('base')

@section('content')

<h1>Rol bewerken</h1>

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Naam:</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ $role->name }}"
        required
    >

    <br><br>

    <label for="guard_name">Guard:</label>
    <input
        type="text"
        id="guard_name"
        value="{{ $role->guard_name }}"
        readonly
    >

    <br><br>

    <button type="submit" class="btn btn-primary">
        Wijzigingen opslaan
    </button>
</form>

@endsection
