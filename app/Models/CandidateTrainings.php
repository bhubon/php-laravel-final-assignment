<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateTrainings extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'training_name',
        'institute_name',
        'passing_year',
    ];
}
