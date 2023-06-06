<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $primarykey = "member_id";
    public function getGroup()
    {
        return $this->hasMany('App\Models\group','group_id');
    }
}
