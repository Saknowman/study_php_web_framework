<?php


namespace TaskApp\Entities;


use Libs\DB\Entity;

class Task extends Entity
{
    public string $title;
    public string $status;

    public static function columns()
    {
        return ['title', 'status'];
    }
}