<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function projects() {
        return $this->belongsTo(Project::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
