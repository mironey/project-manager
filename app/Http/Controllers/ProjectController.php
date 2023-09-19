<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
       return view('dashboard', [
        'wire' => 'project-index'
       ]);
    }

    public function show($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'project-show'
        ]);
    }

    public function create() {
        return view('dashboard', [
            'wire' => 'project-create'
        ]);
    }

    public function edit($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'project-edit'
        ]);
    }

    public function submit($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'project-submit'
        ]);
    }

    public function delivery($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'project-delivery'
        ]);
    }
}
