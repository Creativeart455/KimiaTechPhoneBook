<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['phoneNumber'];
    use HasFactory;
    public function contact(  ) {
        $this->belongsTo(Contact::class);
    }
}
