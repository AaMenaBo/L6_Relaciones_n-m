@extends('layouts.app')
@section('content')
    <h1>Tarea ID: {{ $task->id }}</h1>
    <span class="badge text-bg-warning">{{ $task->priority?->name }}</span>
    <hr>
    <h2>{{ $task->name }}</h2>
    <p>{{ $task->description }}</p>
    <span>
        @foreach ($task->tags as $tag)
            <span class="badge text-bg-primary">{{ $tag->name }}</span>
        @endforeach
    </span>
    <hr>
    <a href="/tasks/{{ $task->id }}/edit">Editar</a>
@endsection
