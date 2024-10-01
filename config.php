<?php
// Define ROOT_PATH
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROOT_URL', 'http://' . $_SERVER['HTTP_HOST']);

// Load Composer's autoload
require_once ROOT . '/vendor/autoload.php'; // Assurez-vous que ce chemin est correct

// Load env
require_once ROOT . '/includes/libs/DotEnv.php';
(new DotEnv(ROOT.'/.env'))->load(); // Assurez-vous que le fichier .env existe à cet emplacement

// Defines
require_once ROOT . '/config/defines.php';

// Debug
if (getenv('APP_DEBUG') == 'true') {
    require_once ROOT . '/config/debug.php';
}

// Load functions
require_once ROOT . '/functions/global.inc.php';

// Load security
require_once ROOT . '/config/security.php';
