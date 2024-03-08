<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanidateEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'degree_type',
        'institute_name',
        'department',
        'passing_year',
        'cgpa'
    ];
}
