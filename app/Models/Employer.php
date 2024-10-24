<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ['company_name'];
    
    public function jobOffers(): HasMany{
        return $this->hasMany(JobOffer::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
