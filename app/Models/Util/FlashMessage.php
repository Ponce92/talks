<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Model;

class FlashMessage extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function getMessage($type,$mess)
    {
        $flash=['type'=>$type,'message'=>$mess];

        return $flash;
    }

}
