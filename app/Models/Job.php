<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'salary',
        'job_type',
        'vacancy',
        'job_nature',
        'deadline',
        'company_id',
        'category_id',
        'user_id',
    ];
}
