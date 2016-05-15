# CLogger
A simple class that logs your errors to files.

How to install
---------------
This repo is avaiable through packagist with the command:
```
composer require krysvac/clogger
```
How to use
----------
You will need to call these static functions to initialize the class.
```php
// A folder called 'log' will be created in your output folder.
// This is where all the files will be created in.
CLogger::setOutputDir("/path/to/your/output/folder");

// Initializes class
CLogger::init();
```

This CLogger class uses [set_error_handler()](http://php.net/manual/en/function.set-error-handler.php) to write the errors on the file.
It's recommended to initialize the class as early as possible

Once initialized, all errors will be written to a file
To trigger an error use [trigger_error()](http://php.net/manual/en/function.trigger-error.php).
```php
trigger_error("This is a warning!", E_USER_WARNING);
```

Also note that this function will not use [error_reporting()](http://php.net/manual/en/function.error-reporting.php) to set which errors to display, instead you need to set it yourself.   
Example:
```php
error_reporting(E_ALL);
CLogger::init();
```

License
--------
This code is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).