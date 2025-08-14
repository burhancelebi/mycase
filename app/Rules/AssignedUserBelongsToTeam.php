<?php

namespace App\Rules;

use App\Models\Team;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class AssignedUserBelongsToTeam implements ValidationRule
{
    protected ?int $teamId = null;

    public function __construct(?int $teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_null($this->teamId)) {
            $team = Team::query()->find($this->teamId);
            $exists = $team->members()->where('users.id', $value)->exists();

            if ($exists === false) {
                $fail('Atanan kullanıcı belirlenen takıma ait değil');
            }
        }
    }
}
