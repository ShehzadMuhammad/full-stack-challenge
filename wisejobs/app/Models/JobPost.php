<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\PositionTypeEnum;


class JobPost extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo(Company::class);
    }

    protected $fillable = [
        'job_title', 'salary', 'location', 'position_type', 'company_id'
    ];

    protected $casts = [
        'position_type' => PositionTypeEnum::class
    ];
}
