<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\NumberOfEmployeesEnum;

class Company extends Model
{
    use HasFactory;

    public function jobposts(): HasMany
    {
        return $this->hasMany(JobPost::class);
    }

    protected $fillable = [
        'name', 'industry', 'location', 'number_of_employees'
    ];

    protected $casts = [
        'number_of_employees' => NumberOfEmployeesEnum::class
    ];
}
