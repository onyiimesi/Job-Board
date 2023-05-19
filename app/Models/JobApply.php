<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'job_id',
        'job_title',
        'job_description'
    ];
}
