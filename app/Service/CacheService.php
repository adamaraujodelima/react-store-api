<?php

namespace App\Service;

use Cache;
use App\Post;
use App\User;

class CacheService{
    
    static function clearCachePosts(Post $post)
    {
        Cache::forget('posts.all');
        Cache::forget('posts.all.recents');
        Cache::forget('admin.posts.all.recents');
        Cache::forget('posts.all.' . $post->user->id);
        Cache::forget('post.entity.' . $post->id);

        return true;
    }

    static function clearCacheUsers(User $user)
    {
        Cache::forget('users.all');
        Cache::forget('user.entity.' . $user->id);

        return true;
    }
}