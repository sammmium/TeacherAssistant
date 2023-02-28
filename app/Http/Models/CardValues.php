<?php

namespace App\Http\Models;

class CardValues extends BaseModel
{
    protected $table = 'card_values';

    protected $fillable = [
        'card_id',
        'dict_id',
        'value',
    ];

    public $timestamps = false;


}
