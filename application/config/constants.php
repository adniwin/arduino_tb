<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', true);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate  for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */

defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('BASE_URL', 'http://localhost/standar_ci/public/sensor/');
define('ADMIN_WEBAPP_URL', BASE_URL . "admin/");
define('BACKEND_STATIC_FILES', BASE_URL . 'assets/statics/backend/');
define('FRONTEND_STATIC_FILES', BASE_URL . 'assets/statics/frontend/');
define('BACKEND_IMAGE_FOLDER', BASE_URL . 'assets/images/backend/');


define('WEB_ACCESS', 'w');
define('MOBILE_ACCESS', 'm');
define('FAIL_STATUS', "FAIL");
define('FAIL_MESSAGE', "Failed");
define('FAIL_UPLOAD_MESSAGE', "Upload gagal");
define('OK_STATUS', "OK");
define('OK_MESSAGE', "Success");
define('OK_UPLOAD_MESSAGE', "Upload berhasil");
define('NO_DATA_STATUS', "NONE");
define('NO_DATA_MESSAGE', "Data tidak ditemukan");
define('EMPTY_POST_STATUS', "NONE");
define('EMPTY_POST_MESSAGE', "Data kosong");
define('SERVER_SECRET_KEY', 'singgasanabersama123456');
define('JWT_ALGHORITMA', 'HS256');
define('BACKEND_IMAGE_DIRECTORY', 'assets/images/backend/');
define('NEW_CONTENT_STATUS', 'N');
define('NEW_CONTENT_CAPTION', 'New');
define('ACTIVE_CONTENT_STATUS', 'A');
define('ACTIVE_CONTENT_CAPTION', 'Active');
define('CLICKED_LOG_MAIL_STATUS', 'D');
define('CLICKED_ACTION_MESSAGE', 'Aksi ini sudah pernah dilakukan');
define('PENDING_CONTENT_STATUS', 'P');
define('PENDING_CONTENT_CAPTION', 'Ditunda');
define('NO_IMG', 'no-img.jpg');
define('GET_COUNT', 'COUNT');
define('GET_DETAIL', 'DETAIL');

define('MAIN_EMAIL', "iproguide.2016@gmail.com");
define('MAIN_EMAIL_PASSWORD', "cariajadigoogle123");
define('MAIN_EMAIL_NAME', "Iproguide Administrator");
define('EMAIL_SUBJECT_GUIDE_REGISTRATION_VERIFICATION', "Iproguide New Guide Registration");
define('EMAIL_REGISTRATION_SUCCESS_MESSAGE', "Registration berhasilfully, please check your email to validate and activate your account");
