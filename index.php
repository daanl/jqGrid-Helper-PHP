<?php
$language = 'en';

if (isset($_GET['lang']))
{
	switch ($_GET['lang'])
	{
		case 'nl':
			$language = 'nl';
			break;
		case 'en':
			$language = 'en';
			break;
	}
}

$page = (isset($_GET['p'])) ? $_GET['p'] : 'basic';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="nl">
<head>
<link rel="stylesheet" type="text/css" href="css/site.css" />

<script type="text/javascript" src="js/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.jqgrid/js/i18n/grid.locale-en.js"></script>
<script type="text/javascript" src="js/jquery.jqgrid/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="js/jquery.ui/jquery.ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/jqgrid/redmond/jquery-ui-1.7.1.custom.css" />
<link rel="stylesheet" type="text/css" href="js/jquery.jqgrid/css/ui.jqgrid.css" />

</head>
<body>
    <div class="page">

        <div id="header">
            <div id="title">
                <h1>PHP jqGrid Helper</h1>
            </div>


            <div id="menucontainer">

		      <ul id="menu">
                    <li><a href="?p=basic&lang=<?php echo $language ?>">Basic Example</a></li>
                    <li><a href="?p=search&lang=<?php echo $language ?>">Search</a></li>
                    <li><a href="?p=toolbar&lang=<?php echo $language ?>">Toolbar</a></li>
                    <li><a href="?p=multiselect&lang=<?php echo $language ?>">Multiselect</a></li>

                    <li><a href="?p=formatters&lang=<?php echo $language ?>">Formatters</a></li>
                    <li><a href="?p=events&lang=<?php echo $language ?>">Events</a></li>
                    <li><a href="?p=about&lang=<?php echo $language ?>">About</a></li>
                	<li><a href="?p=<?php echo $page ?>&lang=<?php echo ($language == 'en') ? 'nl' : 'en';?>"><img style="border:0px" src="images/<?php echo ($language == 'en') ? 'nl' : 'en';?>.gif"></img></a></li>
                </ul>

            </div>
        </div>

        <div style="clear:both"></div>

        <div id="main">

<?php
include('jqGrid.php');

$filepath = 'examples/' . $language . '_' . $page . '_example.php';

if (file_exists($filepath))
{
	include_once($filepath);
}
?>

	<div id="footer">
		Created by Daan Le Duc, 2010, The Netherlands
	</div>
	</div>

</div>
</body>