<?php

namespace App\Api;

use ArrayAccess;

class WishModel
{
    public int $id;
    public string $title;
    public string $description;
    public int $wishlist_id;
    public string $status;
}