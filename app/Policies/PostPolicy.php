<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Traits\PolicyResponseTrait;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use PolicyResponseTrait;
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): Response
    {
        return $this->applyPolicy(
            $post->user_id === $user->id,
            'You do not have permission to view this post.'
        );
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): Response
    {
        return $this->applyPolicy(
            $post->user_id === $user->id,
            'You do not have permission to update this post.'
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        return $this->applyPolicy(
            $post->user_id === $user->id,
            'You do not have permission to delete this post.'
        );
    }
}
