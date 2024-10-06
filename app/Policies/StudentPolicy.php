<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function modify(User $user, Student $student): Response
    {
        return $student->User_id === $user->id
            ? Response::allow()
            : Response::deny('You do not own this student.');
    }

}
