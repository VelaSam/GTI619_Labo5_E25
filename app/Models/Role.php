<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $guarded =[];
    
    public function permissions(){
        return $this->BelongsToMany(Permission::class)->withTimestamps();
    }

    public function allowTo($permission){
        $this->permissions()->save($permission);
    }
}
