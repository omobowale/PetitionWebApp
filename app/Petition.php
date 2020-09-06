<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Signature;
use App\Update;
use App\User;

class Petition extends Model
{
    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    public function updates()
    {
        return $this->hasMany(Update::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
