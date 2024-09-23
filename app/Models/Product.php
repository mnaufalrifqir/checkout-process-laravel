<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product
{
    public $name;
    public $price;
    public $description;
    public $image;

    public function __construct($name, $price, $description, $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }
}
