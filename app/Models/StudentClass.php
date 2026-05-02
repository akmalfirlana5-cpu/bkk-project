<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = ['major_id', 'name'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
