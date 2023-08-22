<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
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

    public function task() {
        return $this->belongsTo(Task::class);
    }
}
