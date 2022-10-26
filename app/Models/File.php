<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class File extends Model
{
    use HasFactory;
    use Sortable; 

    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active',
    ];
    
    public $sortable = ['id', 'title', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function getCategoriesString()
    { 
        $categoriesString = "";

        $categories = $this->belongsToMany(Category::class)->get();

        foreach($categories as $category){
            if($categoriesString != ""){
                $categoriesString = $categoriesString .  "-" . $category->title;
            } else {
                $categoriesString =  $category->title;
            }
            
        }

        return $categoriesString;
    }
}
