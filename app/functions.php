<?php

$files = glob(__DIR__ . '/functions/*.php');
if ($files !== false) {
    foreach ($files as $file) {
        require_once $file;
    }
}
unset($file);
unset($files);
