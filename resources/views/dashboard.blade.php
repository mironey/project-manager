@extends('layouts.app')

@section('content')

@if(Auth::user()->hasRole('admin'))

    @switch($wire)

        @case('dashboard-index')
            <livewire:admin.admin-dashboard /> 
            @break

        @case('project-index')
            <livewire:project.project-index /> 
            @break

        @case('project-show')
            <livewire:project.project-show :projectId='$id' /> 
            @break
        
        @case('project-create')
            <livewire:project.project-create /> 
            @break

        @case('project-edit')
            <livewire:project.project-edit :projectId='$id' /> 
            @break

        @case('task-index')
            <livewire:task-index /> 
            @break

        @case('task-show')
            <livewire:task.task-show :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('task-create')
            <livewire:task.task-create :projectId='$id' /> 
            @break

        @case('task-edit')
            <livewire:task.task-edit :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('assignment-create')
            <livewire:assignment.assignment-create :projectId='$projectId' :taskId='$taskId' /> 
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
            <livewire:project.project-show :projectId='$id' /> 
            @break

        @case('task-index')
            <livewire:task.task-index /> 
            @break

        @case('task-show')
            <livewire:task.task-show :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('task-create')
            <livewire:task.task-create :projectId='$id' /> 
            @break

        @case('task-edit')
            <livewire:task.task-edit :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('assignment-create')
            <livewire:assignment.assignment-create :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @default
            <livewire:manager.manager-dashboard /> 
    @endswitch

@elseif(Auth::user()->hasRole('supervisor'))

    @switch($wire)

        @case('dashboard-index')
            <livewire:supervisor.supervisor-dashboard /> 
            @break

        @case('task-show')
            <livewire:task.task-show :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('assignment-show')
            <livewire:assignment.assignment-show :projectId='$projectId' :taskId='$taskId' :assignmentId='$assignmentId' /> 
            @break

        @case('assignment-create')
            <livewire:assignment.assignment-create :projectId='$projectId' :taskId='$taskId' /> 
            @break

        @case('assignment-edit')
            <livewire:assignment.assignment-edit :projectId='$projectId' :taskId='$taskId' :assignmentId='$assignmentId' /> 
            @break

        @default
            <livewire:member.member-dashboard /> 
    @endswitch

@elseif(Auth::user()->hasRole('member'))

    @switch($wire)

        @case('dashboard-index')
            <livewire:member.member-dashboard /> 
            @break

        @case('assignment-show')
            <livewire:assignment.assignment-show :projectId='$projectId' :taskId='$taskId' :assignmentId='$assignmentId' /> 
            @break

        @default
        <livewire:member.member-dashboard /> 
    @endswitch

@endif

@endsection
