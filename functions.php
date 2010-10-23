<?php


/**
 * Build where clause string
 * @param array $fields associative array key value
 * @return string whereclause
 */
function buildWhereClause(Array $fields)
{
	// no fields? no whereclause
	if (count($fields) == 0) { return ''; }

	// setup whereclause
	$whereclause = ' WHERE ';
	$wherefields = array();

	// loop trough fields and build whereclause
	foreach ($fields AS $key => $value)
	{
		$wherefields[] = mysql_escape_string($key)  . " LIKE '%" . mysql_escape_string($value) . "%' ";
	}

	// add all fields to string
	$whereclause .= implode(' AND ', $wherefields);

	return $whereclause;
}

/**
 * Build order by
 * @param string $sidx sort index
 * @param string $sord sort order
 * @return string orderby
 */
function buildOrderBy($sidx, $sord)
{
	// no sort index? no sorting
	if (!$sidx) { return ''; }

	return " ORDER BY " . mysql_escape_string($sidx) . " " . mysql_escape_string($sord);
}

/**
 * Build limit string
 * @param int $page page index
 * @param int $limit page limit
 * @return string limit
 */
function buildLimit($page, $limit)
{
	// validate page
	if (!ctype_digit((string) $page))
	{
		throw new Exception('Page not digit');
	}

	// validate limit
	if (!ctype_digit((string) $limit))
	{
		throw new Exception('Limit not digit');
	}

	// set paging
	$limit_page = $limit * $page - $limit;

	// set limit
	return ' LIMIT '. $limit_page . ", " . $limit;
}

/**
 * Connects to database
 * @param array $database associative array with database information
 * @return mysql resource
 */
function connect2database(Array $database)
{
	// connect to database server
	if (!$connection = mysql_connect($database['host'], $database['username'], $database['password']))
	{
		throw new Exception('Failed to connect to database');
	}

	// select database
	if (!mysql_select_db($database['name'], $connection))
	{
		throw new Exception('Failed to select the database');
	}

	return $connection;
}

/**
 * Gets films array
 * @param array $where associative array key value
 * @param string $sidx sorting index
 * @param string $sord sorting order
 * @param int $page sorting page
 * @param int $limit sorting limit
 * @return array films data
 */
function getFilms($where, $sidx, $sord, $page, $limit)
{
	$data = array();

	// setup query to fetch films
	$query = "	SELECT
					*
				FROM
					 film
			";

	// build where, orderby and limit
	$query .= buildWhereClause($where);
	$query .= buildOrderBy($sidx, $sord);
	$query .= buildLimit($page, $limit);

	// execute query
	$result = mysql_query($query);

	// validate result
	if (!$result)
	{
		throw new Exception('Query failed unable to fetch data ' . mysql_error());
	}

	// fill array data
	while ($row = mysql_fetch_assoc($result))
	{
		$data[] = $row;
	}

	return $data;
}

/**
 * Get films count
 * @param array $where  associative array key value
 * @return int total films count
 */
function getFilmsCount($where)
{
	// retrieve total records count
	$query = "	SELECT
					count(*) as count
				FROM
					film
			";

	// build where
	$query .= buildWhereClause($where);

	// execute query
	$result = mysql_query($query);

	// validate result
	if (!$result)
	{
		throw new Exception('Query failed unable to fetch data ' . mysql_error());
	}

	// retrieve count
	$row =  mysql_fetch_assoc($result);

	return $row['count'];
}

/**
 * Decodes filters which are returned by jqgrid
 * @param $filters Filters returned by jqgrid
 * @return array Filters
 */
function decodeFilters($filters)
{
	// setup the filter array
	$aFilters	= array();

	// Decode filter objects
	$oFilterObjects	= json_decode($filters);

	// if there are any filter objects
	if ($oFilterObjects && count($oFilterObjects->rules) > 0)
	{
		// loop trough the filter objets and set key => value
		foreach ($oFilterObjects->rules as $oFilter)
		{
			$aFilters[$oFilter->field] = $oFilter->data;
		}
	}
	return $aFilters;
}

function getAllTitles()
{
	// retrieve total records count
	$query = "	SELECT
					title
				FROM
					film
				GROUP BY
					title
			";

	// execute query
	$result = mysql_query($query);

	// validate result
	if (!$result)
	{
		throw new Exception('Query failed unable to fetch data ' . mysql_error());
	}

	$titles = array();

	// retrieve count
	while ($row  =  mysql_fetch_assoc($result))
	{
		$titles[] = $row['title'];
	}

	return $titles;
}