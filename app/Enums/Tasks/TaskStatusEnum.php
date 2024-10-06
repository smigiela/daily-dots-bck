<?php

namespace App\Enums\Tasks;

enum TaskStatusEnum: string
{
    case new = 'new';
    case in_progress = 'in_progress';
    case complete = 'complete';
}
