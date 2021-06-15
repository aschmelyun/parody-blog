<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $appends = ['comment_count'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getCommentCountAttribute()
    {
        return $this->comments()->count();
    }
}
