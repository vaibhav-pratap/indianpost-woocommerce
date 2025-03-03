<?php
class IndianPost_Logger {
    public static function log($message) {
        $log_file = INDIANPOST_PLUGIN_DIR . 'logs/indianpost.log';
        file_put_contents($log_file, "[" . date("Y-m-d H:i:s") . "] " . $message . PHP_EOL, FILE_APPEND);
    }
}
