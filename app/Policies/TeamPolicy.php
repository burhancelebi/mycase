<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    /**
     * @param User $user
     * @param Team $team
     * @return Response
     *
     * Determine whether the user can add a member.
     */
    public function addMember(User $user, Team $team): Response
    {
        return $user->id === $team->owner_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }

    /**
     * @param User $user
     * @param Team $team
     * @return Response
     *
     * Determine whether the user can delete the model.
     */
    public function removeMember(User $user, Team $team): Response
    {
        return $user->id === $team->owner_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
