<?php

namespace App\Enums\Tasks;

enum TaskTypesEnum: string
{
    case task = 'task';
    case meeting = 'meeting';
    case visit = 'visit';
}
