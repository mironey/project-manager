<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'due_date',
        'priority',
        'status',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function assignment() {
        return $this->hasMany(Assignment::class);
    }

    public function assignmentsByStatus()
    {
        return $this->assignment()
            ->select('status', DB::raw('count(*) as count'), DB::raw('MAX(name) as name'), DB::raw('MAX(id) as id'))->groupBy('status')->get();
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

}
