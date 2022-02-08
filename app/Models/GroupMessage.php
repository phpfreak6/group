<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class GroupMessage extends Model
{
    protected $table = 'group_messages';
    protected $primaryKey = 'group_message_id';
    protected $fillable = [
        'group_message_id',
        'group_id',
        'user_id',
        'body',
        'read_status',
        'created_at',
        'updated_at'
    ];

    protected $casts = ['read_status' => 'array'];

    function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'group_id');
    }
}
