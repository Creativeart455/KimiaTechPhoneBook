<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['addressString'];
    use HasFactory;
    public function contact(  ) {
        $this->belongsTo(Contact::class);
    }

}
