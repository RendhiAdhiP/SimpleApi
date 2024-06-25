<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $table = "addresses";
    protected $primaryKey = "id";
    protected $keytype = "int";
    protected $incrementing = true;
 
    public function contact(): BelongsTo {
        return $this->belongsTo(contact::class, "contact_id", "id");
    }

}
