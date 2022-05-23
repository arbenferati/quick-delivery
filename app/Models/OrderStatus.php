<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'order_status';

    public function getAllStatuses()
    {
        return $this::all();
    }

    public function createStatus(string $name)
    {
        return $this::create(['name' => $name]);
    }

}
