<?php

namespace App\Models\Diary;

use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\Diary/TaskFactory> */
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
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
        'start_time'         => 'datetime:Y-m-d H:i:s',
        'stop_time'           => 'datetime:Y-m-d H:i:s',
        'status_change_date' => 'datetime:Y-m-d H:i:s',
        'created_at'         => 'datetime:Y-m-d H:i:s',
        'updated_at'         => 'datetime:Y-m-d H:i:s',
        'status'             => TaskStatusEnum::class,
        'type'               => TaskTypesEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
