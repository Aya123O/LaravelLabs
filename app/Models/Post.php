<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


    class Post extends Model

{   
    public function getCreatedAtAttribute($value){
    return Carbon::parse($value)->format('Y-m-d H:i');
}

    protected $fillable = ['title', 'description', 'user_id','image'];
    
    public function user()
    {
        return $this->belongsTo(User::class);   //foreignKey:'user_id'=> if you change the name of function 
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    use HasFactory,Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true, // Update slug when title changes
                'unique' => true,
                'uniqueSuffix' => '-:id'
            ]
        ];
    }
    use SoftDeletes;
    protected $dates = ['deleted_at']; 

}

