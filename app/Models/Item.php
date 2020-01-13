<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MyModel;

class Item extends MyModel
{
    protected $table = 'items';
    
    public function filterId($id){
        $this->setFunctionCond('where', ['id', $id]);
        return $this;
    }

    public function filterName($name){
        if(!empty($name)){
            $this->setFunctionCond('where', ['name', 'like', "%$name%"]);
        }
        
        return $this;
    }
}
