<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GroupParticipant;
use App\Models\GroupMessages;

class Group extends Model
{

    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    protected $fillable = ['group_id', 'user_id', 'group_name', 'created_at', 'updated_at'];

    /* Group And Participants Relationship */
    function participants()
    {
        return $this->hasMany(GroupParticipant::class, 'group_id', 'group_id');
    }

    /* Group And Messages Relationship */
    function messages()
    {
        return $this->hasMany(GroupMessages::class, 'group_id', 'group_id');
    }
}
