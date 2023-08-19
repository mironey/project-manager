@extends('layouts.app')

@section('content')

@if(Auth::user()->hasRole('admin'))

    @switch($wire)

        @case('dashboard-index')
            <livewire:admin.admin-dashboard /> 
            @break

        @case('project-index')
            <livewire:project-index /> 
            @break

        @case('project-show')
            <livewire:project-show :projectId='$id' /> 
            @break
        
        @case('project-create')
            <livewire:project-create /> 
            @break

        @case('project-edit')
            <livewire:project-edit :projectId='$id' /> 
            @break

        @case('task-index')
            <livewire:task-index /> 
            @break

        @case('task-show')
            <livewire:task-show :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('task-create')
            <livewire:task-create :projectId='$id' /> 
            @break

        @case('task-edit')
            <livewire:task-edit :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @default
            <livewire:admin.admin-dashboard /> 
    @endswitch

@elseif(Auth::user()->hasRole('manager'))

    @switch($wire)

        @case('dashboard-index')
            <livewire:manager.manager-dashboard /> 
            @break

        @case('project-show')
            <livewire:manager.project-show :projectId='$id' /> 
            @break

        @case('task-index')
            <livewire:task-index /> 
            @break

        @case('task-show')
            <livewire:task-show :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('task-create')
            <livewire:task-create :projectId='$id' /> 
            @break

        @case('task-edit')
            <livewire:task-edit :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @default
            <livewire:manager.manager-dashboard /> 
    @endswitch

@elseif(Auth::user()->hasRole('member'))

    @switch($wire)

        @case('dashboard-index')
            <livewire:member.member-dashboard /> 
            @break

        @case('task-show')
            <livewire:task-show :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @default
            <livewire:member.member-dashboard /> 
    @endswitch

@endif

@endsection
