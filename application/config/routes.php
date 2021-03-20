<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'web';
$route['beranda'] = 'web/index';
$route['dandes'] = 'web/dandes';
// $route['galeri'] = 'web/galeri';
$route['tentang'] = 'web/tentang';
$route['kontak'] = 'web/kontak';
$route['pendapatan'] = 'web/pendapatan';
$route['404_override'] = 'web/notfound';
$route['translate_uri_dashes'] = FALSE;
$route['subbidang'] = 'bidang/subBidang';
$route['subprogram'] = 'program/subProgram';

//Rest API
$route['api/user'] = 'rest/api/users';
$route['api/bidang'] = 'rest/api/bidang';
$route['api/pendapatan'] = 'rest/api/apendapatan';
$route['api/abidang'] = 'rest/api/abidang';
$route['api/galeri'] = 'rest/api/galeri';
$route['api/program'] = 'rest/api/program';
$route['api/rincian'] = 'rest/api/rincian';
$route['api/rincians'] = 'rest/api/rincians';
$route['api/rb'] = 'rest/api/rb';
$route['api/rt'] = 'rest/api/rt';
$route['api/saran'] = 'rest/api/saran';