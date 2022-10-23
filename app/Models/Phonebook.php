<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    use HasFactory;



    public function contacts() {
        return $this->belongsToMany(Contact::class,'phonebooks_contacts');
    }

    public function user(  ) {
        return $this->belongsTo(User::class);
    }
}
