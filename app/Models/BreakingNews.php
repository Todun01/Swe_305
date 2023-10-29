<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BreakingNews extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'post_id',
    ];

    public function post(): BelongsTo {
        return $this->belongsTo( Posts::class, 'post_id', 'id' );
    }
}
