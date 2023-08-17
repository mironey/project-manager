@extends('layouts.app')

@section('content')

@switch($wire)
    @case('index')
        <livewire:project-index /> 
        @break

    @case('show')
        <livewire:project-show :projectId='$id' /> 
        @break

    @case('edit')
        <livewire:project-edit :projectId='$id' /> 
        @break
    
    @case('create')
        <livewire:project-create /> 
        @break

    @case('task-create')
        <livewire:task-create :projectId='$id' /> 
        @break

    @case('task-show')
        <livewire:task-show :projectId='$projectId' :taskId='$taskId' /> 
        @break

    @case('task-edit')
        <livewire:task-edit :projectId='$projectId' :taskId='$taskId' /> 
        @break

    @default
        <livewire:project-index /> 
@endswitch

@endsection
