@extends('layouts.app')
@section('content')
    <h1>Creado una tarea</h1>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/tasks" method="POST">
        @csrf
        {{-- Nombre --}}
        <div>
            <label class="form-label" for="name">Nombre</label>
            <input class="form-control" type="text" name="name" id="name">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        {{-- Prioridad --}}
        <div>
            <label class="form-label" for="name">Prioridad</label>
            <select name="priority_id" id="priority_id" class="form-control">
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                @endforeach

            </select>
            @error('priority_id')
                <p>{{ $message }}</p>
            @enderror
        </div>
        {{-- Usuario --}}
        <div>
            <label class="form-label" for="name">Usuario</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <p>{{ $message }}</p>
            @enderror
        </div>
        {{-- Etiquetas --}}
        <div>
            <label class="form-label" for="tags">Etiquetas</label>
            <div>
                @foreach ($tags as $tag)
                    <input class="form-check-input" type="checkbox"
                        value="{{ $tag->id }}"id="checkbox-{{ $tag->id }}" name="tags[]">
                    <label class="form-check-label" for="checkbox-{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>
        {{-- Descripción --}}
        <div>
            <label class="form-label" for="description">Descripción</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear tarea</button>
    </form>
@endsection
