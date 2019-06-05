<?php

require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";

\Elgg\Application::start();

_elgg_services()->simpleCache->invalidate();
_elgg_services()->systemCache->reset();

error_log('Cache has been flushed');
