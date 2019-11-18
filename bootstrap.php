<?php
require_once 'Config/ProjectSettings.php';
require_once 'Config/DirectorySettings.php';
require_once 'Libs/Utils/AutoLoader.php';

use Config\ProjectSettings;
use Config\DirectorySettings;
use Libs\Utils\AutoLoader;

if (ProjectSettings::IS_DEBUG)
    ini_set('display_errors', 'On');

$auto_loader = new AutoLoader(DirectorySettings::APPLICATION_ROOT_DIR);
$auto_loader->run();

foreach (ProjectSettings::APPLICATIONS as $APPLICATION){
    $application = new $APPLICATION();
    $application->ready();
}

$project = \Libs\Project::instance();