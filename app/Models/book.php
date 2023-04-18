<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class book extends Model
{
    public $guarded=['id','created_at','updated_at'];

    /**
     * Get the user that owns the book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auther(): BelongsTo
    {
        return $this->belongsTo(auther::class,'auther_id');
    }

    /**
     * Get all of the comments for the book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function genres()
    {
        return $this->belongsToMany(genres::class);
    }


    
   

    public static function getGenres($book_id){
        $names = array();
      
            $genres = DB::table('book_genres')->where('book_id', $book_id)->pluck('genre_id');

            foreach ($genres as $genre_id ) {
                $genre = DB::table('genres')->where('id', $genre_id)->value('title');
                array_push($names,$genre);
            }
            if ($names == null )
                return ("0");
       return ($names);
    }

}
