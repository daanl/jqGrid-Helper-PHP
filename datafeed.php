<?php
// set database settings
$database['username'] = '';
$database['password'] = '';
$database['name']	  = '';
$database['host']	  = '';

if (trim($database['username']) == '' ||
	trim($database['password']) == '' ||
	trim($database['name']) == '' ||
	trim($database['host']) == ''
	)
{
	throw new Exception('Database information not set');
}

// require some database functions
require_once('functions.php');

// set default parameters
$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
$limit = (!isset($_GET['rows'])) ? 10 :  $_GET['rows'];
$sidx = (!isset($_GET['sidx'])) ? 'film_id' : $_GET['sidx'];
$sord = (!isset($_GET['sord']) || $_GET['sord'] === 'asc') ? 'asc' : 'desc';
$where = (!isset($_GET['filters'])) ? array() : decodeFilters($_GET['filters']);

// connect to database
connect2database($database);

// retrieve films and count
$data = getFilms($where, $sidx, $sord, $page, $limit);
$count = getFilmsCount($where);

// setup return parameters
$grid = array();
$grid['rows'] = $data;
$grid['total'] = ($count > 0) ? ceil($count / $limit) : 1;
$grid['page'] = $page;
$grid['records'] =  $count;

// json encode grid array
echo json_encode($grid);
?>