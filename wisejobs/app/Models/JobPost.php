<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PositionTypeEnum;


class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title', 'salary', 'location', 'position_type', 'company_id'
    ];

    protected $casts = [
        'position_type' => PositionTypeEnum::class
    ];
}
