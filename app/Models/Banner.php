<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title', 'desc', 'image', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function imageUrl()
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
