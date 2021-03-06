<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Vendor extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = "vendors";
    protected $fillable = [
        'name',
        'mobile',
        'address',
        'email',
        'logo',
        'password',
        'category_id',
        'active',
        'created_at',
        'updated_at',
    ];
    protected $hidden = ['category_id','password'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSelection($query){
        return $query->select('id', 'category_id', 'active', 'name', 'address', 'email', 'logo', 'mobile');
    }
    public function getLogoAttribute($val){
        return ($val !== 'null')? asset($val) : "sorry this is wrong"; //to get the link before the source of image
    }
        public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    public function maincategory(){
        return $this -> belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }
    public function setPasswordAttribute($password){
        if(! empty($password)){
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
