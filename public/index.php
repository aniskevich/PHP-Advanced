<?php

require_once '../engine/Autoload.php';

use app\engine;

spl_autoload_register([new engine\Autoload(), 'loadClass']);

