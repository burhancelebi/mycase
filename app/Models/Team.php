<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    protected $fillable = [
        'name',
        'description',
        'owner_id',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class,
            'team_members',
            'team_id',
            'user_id'
        );
    }
}
