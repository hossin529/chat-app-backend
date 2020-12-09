<?php

namespace App;
use Storage;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
	protected $fillable = ['name','user_id','path','extension'];	

	protected $appends = ['full_path'];

	public function getFullPathAttribute() {        
        return url(Storage::url($this->path));
    }

    public function user(){
		
		return $this->belongsTo('App\User');
	}
}
