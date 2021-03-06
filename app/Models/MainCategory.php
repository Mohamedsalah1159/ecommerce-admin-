<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\MainCategoryObserver;

class MainCategory extends Model
{
    use HasFactory;
    protected $table = "main_categories";
    protected $fillable = [
        'translation_lang',
        'translation_of',
        'name',
        'slug',
        'photo',
        'active',
        'created_at',
        'updated_at',
    ];
    protected static function boot(){
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }
    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopeSelection($query){
        return $query->select('id', 'translation_lang','name', 'slug', 'photo', 'active', 'translation_of');
    }
    public function getPhotoAttribute($val){
        return ($val !== 'null')? asset($val) : "sorry this is wrong"; //to get the link before the source of image
    }
    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    public function categories(){
        return $this ->hasMany(self::class, 'translation_of');
    }
    public function vendors(){
        return $this -> hasMany('App\Models\Vendor', 'category_id', 'id');
    }
}
