<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
       return view('dashboard', [
        'wire' => 'index'
       ]);
    }

    public function show($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'show'
        ]);
    }

    public function edit($id) {
        return view('dashboard', [
            'id' => $id,
            'wire' => 'edit'
        ]);
    }

    public function create() {
        return view('dashboard', [
            'wire' => 'create'
        ]);
    }
}
