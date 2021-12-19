<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = [
        'deleted_at'
    ];

    protected $fillable = ['title', 'attachment', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
