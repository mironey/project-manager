<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index() {
        return view('dashboard', [
            'wire' => 'assignment-index'
        ]);
    }

    public function show($projectId, $taskId, $assignmentId) {
        return view('dashboard', [
            'projectId' => $projectId,
            'taskId' => $taskId,
            'assignmentId' => $assignmentId,
            'wire' => 'assignment-show'
        ]);
    }

    public function create($projectId, $taskId) {
        return view('dashboard', [
            'projectId' => $projectId,
            'taskId' => $taskId,
            'wire' => 'assignment-create'
        ]);
    }

    public function edit($projectId, $taskId, $assignmentId) {
        return view('dashboard', [
            'projectId' => $projectId,
            'taskId' => $taskId,
            'assignmentId' => $assignmentId,
            'wire' => 'assignment-edit'
        ]);
    }

    public function submit($projectId, $taskId, $assignmentId) {
        return view('dashboard', [
            'projectId' => $projectId,
            'taskId' => $taskId,
            'assignmentId' => $assignmentId,
            'wire' => 'assignment-submit'
        ]);
    }
}
