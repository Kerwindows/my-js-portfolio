<?php
function declare_constants(){
// Assign file paths to PHP constants admin folder
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("INCLUDES", dirname(__FILE__));   //dir to includes folder
define("PROJECT_PATH", dirname(dirname(INCLUDES))); //dir to root folder

// Assign file paths
define("ROOT_PATH", PROJECT_PATH . '/src'); //dir to root folder
define("UTILS_PATH", PROJECT_PATH . '/src/utils'); //dir to utils folder
define("ASSETS_PATH", PROJECT_PATH . '/assets'); //dir to assets folder
define("PRIVATE_INCLUDES_PATH", PROJECT_PATH . '/src/app/private/includes'); //dir to includes folder
define("PRIVATE_CLASSES_PATH", PROJECT_PATH . '/src/app/private/classes'); //dir to classes folder
define("PRIVATE_FUNCTIONS_PATH", PROJECT_PATH . '/src/app/private/functions'); //dir to functions folder
define("PRIVATE_VIEWS_PATH", PROJECT_PATH . '/src/app/private/views'); //dir to views folder
define("PRIVATE_PLUGINS_PATH", PROJECT_PATH . '/src/app/private/plugins'); //dir to plugins folder
define("PRIVATE_COMPONENTS_PATH", PROJECT_PATH . '/src/app/private/components'); //dir to components folder
define("PRIVATE_CONTAINERS_PATH", PROJECT_PATH . '/src/app/private/containers'); //dir to container folder
define("PRIVATE_FEATURES_PATH", PROJECT_PATH . '/src/app/private/features'); //dir to features folder
define("PRIVATE_MODELS_PATH", PROJECT_PATH . '/src/app/private/models'); //dir to modals folder
define("PRIVATE_MEDIA_PATH", PROJECT_PATH . '/src/assets/private/media'); //dir to media folder
define("PRIVATE_TEMPLATES_PATH", PROJECT_PATH . '/src/app/templates'); //dir to templates folder

require(PRIVATE_CLASSES_PATH . '/db.connect.php');
require(PRIVATE_FUNCTIONS_PATH . '/helper.functions.php');
require_once(PRIVATE_FUNCTIONS_PATH . '/custom.toasts.php');

//set secret key for custom encrption
$config = include PROJECT_PATH.'/env.php';
define("appConfigParameter", $config['PRIVATE_KEY']);
}