<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function educations()
    {
        return $this->hasMany(CanidateEducation::class);
    }

    public function trainings()
    {
        return $this->hasMany(CandidateTrainings::class);
    }

    public function skills()
    {
        return $this->hasMany(CandidateSkills::class);
    }

    public function job_experiences()
    {
        return $this->hasMany(CandidateJobExperience::class);
    }
}
