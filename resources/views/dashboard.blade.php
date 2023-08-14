@extends('layouts.app')

@section('content')

@if($wire == 'index')

<livewire:project-index /> 

@elseif($wire == 'show')

<livewire:project-show :projectId='$id' /> 

@elseif($wire == 'edit')

<livewire:project-edit :projectId='$id' /> 

@endif

@endsection
