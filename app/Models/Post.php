<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'admin_id', 'title', 'description', 'post_body', 'slug', 'image', 'status'
    ];

    public function click(): HasMany{ 
        return $this->hasMany(Click::class, 'click_id','id');
    }

    public function comments(): HasMany {
        return $this->hasMany(Comments::class,'comment_id','id');
    }

    public function likes(): HasMany {
        return $this->hasMany(Likes::class,'like_id','id');
    }

    public function admin(): BelongsTo{
        return $this->belongsTo(Admin::class,'admin_id','id');
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class,'category_id','id');
    }
    





}
