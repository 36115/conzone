<?php

namespace TeamTeaTime\Forum\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    public function author(): BelongsTo
    {
        $model = config('forum.integration.user_model');
        if (method_exists($model, 'withTrashed')) {
            return $this->belongsTo($model, 'author_id')->withTrashed();
        }

        return $this->belongsTo($model, 'author_id');
    }

    public function getAuthorDisplayNameAttribute(): ?string
    {
        $attribute = config('forum.integration.displayname');

        if ($this->author !== null) {
            return $this->author->$attribute;
        }

        return null;
    }

    public function getAuthorUserNameAttribute(): ?string
    {
        $attribute = config('forum.integration.username');

        if ($this->author !== null) {
            return $this->author->$attribute;
        }

        return null;
    }

    public function getAuthorRoleAttribute(): ?string
    {
        $attribute = config('forum.integration.role');

        if ($this->author !== null) {
            return $this->author->$attribute;
        }

        return null;
    }

    public function getAuthorProfileImageAttribute(): ?string
    {
        $attribute = config('forum.integration.profile_image');

        if ($this->author !== null) {
            return $this->author->$attribute;
        }

        return null;
    }
}
