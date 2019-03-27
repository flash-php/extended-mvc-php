<?php
/**
 * Welcom to the 'extended MVC php framework' project! 
 * Ingo Andelhofs
 * Copyright 2019 (c)
 */

// Load config file
require_once 'core/config/conf.php';

// Load Extended MVC features
require_once 'core/extended/IO.php';
require_once 'core/extended/Validate.php';
require_once 'core/extended/Redirector.php';
require_once 'core/extended/Authenticate.php';
// require_once 'core/extended/Components.php';

// Load core mvc files
require_once 'core/_/Database.php';
require_once 'core/_/Controller.php';
require_once 'core/_/App.php';

// Create new App
$app = new App();