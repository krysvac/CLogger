<?php
namespace krysvac\Logger;

/**
 * CLogger
 *
 * @package krysvac\CLogger
 * @author Jonathan Sundqvist
 * @version 1.0
 */
class Logger
{
    /**
     * If the Logger should echo or print to file.
     */
    private static $debug = false;
    
    /**
     * output directory
     */
    private static $outputDir = __DIR__ . DIRECTORY_SEPARATOR;
    
    /**
     * Initializes class
     * Need to call setDebug before
     */
    public static function init()
    {
        if (!file_exists(self::getOutput()))
        {
            mkdir(self::getOutput());
        }
        if (!self::$debug)
        {
            set_error_handler([self::class, "errorWriter"]);
        }
    }

    /**
     * If the Logger should echo or print to file.
     *
     */
    public static function setDebug($debug = true)
    {
        self::$debug = $debug;
    }

    /**
     * Sets output directory
     *
     */
    public static function setOutputDir($dir)
    {
        self::$outputDir = $dir;
    }

    /**
     * Returns output directory
     */
    public static function getOutput()
    {
        return self::$outputDir . "log" . DIRECTORY_SEPARATOR;
    }

    /**
     * Writes error to file.
     *
     * @param $errno int - error level
     * @param $errstr string - error message
     * @param $errfile string - filename of error causing file
     * @param $errline int - line number of error
     *
     * @return bool
     */
    public static function errorWriter($errno, $errstr, $errfile, $errline)
    {
        $filename = date("Y-m-d") . ".log";
        $content  = self::getContents($errno, $errstr, $errfile, $errline);
        file_put_contents(self::getOutput() . $filename, implode("\n", $content), FILE_APPEND);

        return true;
    }

    /**
     * Converts errordata to array
     *
     * @param $errno int - error level
     * @param $errstr string - error message
     * @param $errfile string - filename of error causing file
     * @param $errline int - line number of error
     *
     * @return array
     */
    private static function getContents($errno, $errstr, $errfile, $errline)
    {
        $errors = [
            E_WARNING           => "E_WARNING",
            E_NOTICE            => "E_NOTICE",
            E_USER_ERROR        => "E_USER_ERROR",
            E_USER_WARNING      => "E_USER_WARNING",
            E_USER_NOTICE       => "E_USER_NOTICE",
            E_STRICT            => "E_STRICT",
            E_RECOVERABLE_ERROR => "E_RECOVERABLE_ERROR",
            E_DEPRECATED        => "E_DEPRECATED",
            E_USER_DEPRECATED   => "E_USER_DEPRECATED"
        ];

        $errmsg = $errors[$errno];
        $time   = time();
        $date   = date("Y-m-d H:i:s", $time);
        return [
            "Error: $errno ($errmsg)",
            "Unix Time: $time ($date)",
            "File: $errfile",
            "Line: $errline",
            "Message: $errstr"
        ];
    }
}
