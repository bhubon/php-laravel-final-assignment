<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateJobExperience extends Model
{
    use HasFactory;

    protected $fillable = ['candidate_id', 'designation', 'company_name', 'joining_date', 'departure_date'];
}
