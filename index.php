<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * FRONT CONTROLLER
 *
 * This is the front controller for the application, responsible for
 * initializing the base resources and handling the request.
 */

// Set the environment

define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

// Path to the system folder
$system_path = 'system';

// Path to the application folder
$application_folder = 'application';

// The name of the "view" folder
$view_folder = '';

// Set the current directory correctly for CLI requests
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

// Resolve the system path for increased reliability
if (($_temp = realpath($system_path)) !== FALSE) {
    $system_path = $_temp.DIRECTORY_SEPARATOR;
} else {
    // Ensure there's a trailing slash
    $system_path = strtr(rtrim($system_path, '/\\'), '/\\', DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
}

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system folder
define('BASEPATH', $system_path);

// Path to the front controller (this file)
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Name of the "system" folder
define('SYSDIR', basename(BASEPATH));

// The path to the "application" folder
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
} else {
    if (!is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR)) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
    }
    define('APPPATH', BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
}

// The path to the "view" folder
if ($view_folder === '') {
    if (is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR)) {
        $view_folder = APPPATH.'views';
    } else {
        exit('Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF);
    }
} elseif (!is_dir($view_folder)) {
    if (!is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR)) {
        exit('Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF);
    }
    $view_folder = APPPATH.$view_folder;
}
define('VIEWPATH', rtrim($view_folder, '/\\').DIRECTORY_SEPARATOR);

require_once BASEPATH.'core/CodeIgniter.php'; 