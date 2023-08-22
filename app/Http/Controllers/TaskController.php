<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        return view('dashboard', [
            'wire' => 'task-index'
        ]);
    }

    public function show($projectId, $taskId) {
        return view('dashboard', [
            'projectId' => $projectId,
            'taskId' => $taskId,
            'wire' => 'task-show'
        ]);
    }

     public function create($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'task-create'
        ]);
    }

    public function edit($projectId, $taskId) {
        return view('dashboard', [
            'projectId' => $projectId,
            'taskId' => $taskId,
            'wire' => 'task-edit'
        ]);
    }
    
}
