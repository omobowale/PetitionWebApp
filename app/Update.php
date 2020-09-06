<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Petition;

class Update extends Model
{
    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }
}
