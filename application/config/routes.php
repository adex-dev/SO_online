<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth';
$route['logout'] = 'Auth/logout';
$route['home'] = 'home/index';
$route['masteruser'] = 'home/masteruser';
$route['masterscanhasil'] = 'home/masterscanhasil';
$route['masterstore'] = 'home/masterstore';
$route['reportaudit'] = 'home/reportaudit';
$route['uploadmasterstore'] = 'home/uploadmasterstore';
$route['compareaudit'] = 'home/compareaudit';
$route['buataudit'] = 'home/buataudit';
$route['uploadzx'] = 'home/uploadzx';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
