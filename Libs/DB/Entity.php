<?php


namespace Libs\DB;


abstract class Entity
{
    public string $id;

    /**
     * Override this method in subclasses to return entity columns except id like this:
     *
     *  ['user_name', 'password', 'create_at']
     *
     * @return array
     */
    public abstract static function columns();
}