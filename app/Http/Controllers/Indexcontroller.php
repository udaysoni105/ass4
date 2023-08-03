<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Group;

class Indexcontroller extends Controller
{
    public function index()
    {
        return "<pre>" . Member::with('groups')->get() . "<pre>";
    }
    public function group()
    {
        return Group::with('members')->get();
    }
}
