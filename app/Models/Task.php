<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'tasks';

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public static function getSubtasksById($parentId)
    {
        return Task::where(['parent_id'=> $parentId])->get();
    }

}
