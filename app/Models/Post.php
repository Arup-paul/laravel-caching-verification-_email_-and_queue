<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Events\PostCreated;
use App\Events\PostUpdated;
use App\Events\PostDeleted;
class Post extends Model {
    //
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content', 'thumbnail_path', 'status',
    ];

    protected $dates = [
        'created_at'
    ];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'updated' => PostUpdated::class,
        'deleted' => PostDeleted::class,
    ];

    public function category() {
        return $this->belongsTo( Category::class,'category_id' );
    }
    public function user() {
        return $this->belongsTo( User::class );
    }




}
