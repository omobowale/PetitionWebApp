<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Petition;
use App\User;

class Signature extends Model
{
    //
    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
