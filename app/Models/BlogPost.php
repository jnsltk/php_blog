<?php
namespace App\Models;

use App\Core\Model;

class BlogPost extends Model
{
    protected string $table = 'blogpost';

    // TODO: implement update, delete
    public function getTable() {
        return $this->table;
    }
}
