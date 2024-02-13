<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;

class ActivityPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function update(User $user, Activity $activity): bool
    {
        return $user->id === $activity->user_id;
    }
    public function delete(User $user, Activity $activity): bool
    {
        return $user->id === $activity->user_id;
    }


}
