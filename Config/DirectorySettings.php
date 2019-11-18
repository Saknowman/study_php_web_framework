<?php


namespace Config;


class DirectorySettings
{
    public const APPLICATION_ROOT_DIR = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
    public const TEMPLATES_ROOT_DIR = self::APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR;
}