<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class GroupParticipant extends Model
{
    protected $table = 'group_participants';
    protected $primaryKey = 'group_participant_id';
    protected $fillable = ['group_participant_id', 'group_id', 'user_id', 'created_at', 'updated_at'];

    function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'group_id');
    }
}
