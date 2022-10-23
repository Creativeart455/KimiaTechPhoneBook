<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name'];

    public function emails() {
        return $this->hasMany(Email::class);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    public function phonebooks() {
        return $this->belongsToMany(Phonebook::class,'phonebooks_contacts');
    }
}
