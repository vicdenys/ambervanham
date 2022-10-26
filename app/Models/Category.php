<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
      ];

    /**
     * Files for this category
     */
    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
