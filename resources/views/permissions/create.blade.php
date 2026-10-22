
@extends('base')

@section('content')

<h1>Nieuwe permissie</h1>

<form action="{{ route('permissions.store') }}" method="POST">
    @csrf

    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" required>

    <br><br>

    <label for="guard_name">Guard:</label>
    <input type="text" id="guard_name" name="guard_name" value="web" readonly>

    <br><br>

    <button type="submit" class="btn btn-success">
        Opslaan
    </button>
</form>

@endsection
