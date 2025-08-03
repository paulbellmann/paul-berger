<?php

namespace App\Model;

class ItemModel
{
    public function __construct(
        public string $id,
        public string $name,
        public int $price,
    ) {
    }
}
