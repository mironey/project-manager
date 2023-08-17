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

    @default
        <livewire:project-index /> 
@endswitch

@endsection
