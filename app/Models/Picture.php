<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Picture extends Model
{
    use HasFactory;


    protected $fillable = [
        'filename',
        'path',
        'title',
        'description',
        'user_id',
        'size',
        'mime_type',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
