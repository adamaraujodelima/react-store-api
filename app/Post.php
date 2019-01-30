<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
        'id',
        'author_id',
        'title',
        'image',
        'content',
        'published',
        'posted_at',
        'created_at',
        'updated_at'
    ];

     /**
     * Get the user record associated with the post.
     */
    public function user()
    {
        return $this->belongsTo('App\User','author_id');
    }    
}
