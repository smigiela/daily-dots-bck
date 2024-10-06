<?php

namespace App\Models\Diary;

use App\Enums\Tasks\TaskStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\Diary/TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
        'type',
        'status_change_date',
        'due_date',
        'start_time',
        'stop_time',
    ];

    protected $casts = [
        'due_date'           => 'datetime:Y-m-d H:i:s',
        'start_time'         => 'datetime:H:i',
        'end_time'           => 'datetime:H:i',
        'status_change_date' => 'datetime:Y-m-d H:i:s',
        'created_at'         => 'datetime:Y-m-d H:i:s',
        'updated_at'         => 'datetime:Y-m-d H:i:s',
        'status'             => TaskStatusEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
