<h2>Formatters</h2>

<?php
echo Grid::create('myFirstGrid')
		->addColumn(Column::create('film_id')
			->setCustomFormatter('buttonize'))
		->addColumn(Column::create('title'))
		->addColumn(Column::create('description'))
		->addColumn(Column::create('last_update')
			->setFormatter('date', array(	'srcformat' => 'Y-m-d H:i:s',
											'newformat' => 'Y')))
		->setCaption('My First grid')
		->setUrl('datafeed.php')
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setWidth(840)
		->setPagerPos('center')
		->setPager('mypager')
?>

<script type="text/javascript">
    function buttonize(cellvalue, options, rowobject) {
        return '<input type="button" value="' + cellvalue + '" onclick="alert(' + cellvalue + ')">';
    }
</script>

<pre>
<b>Source:</b>
<?php echo htmlentities('<?php echo Grid::create("myFirstGrid")
		->addColumn(Column::create("film_id")
			->setCustomFormatter("buttonize"))
		->addColumn(Column::create("title"))
		->addColumn(Column::create("description"))
		->addColumn(Column::create("last_update")
			->setFormatter("date", array(
						"srcformat" => "Y-m-d H:i:s",
						"newformat" => "Y")))
		->setCaption("My First grid")
		->setUrl("datafeed.php")
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setWidth(840)
		->setPagerPos("center")
		->setPager("mypager")
?>

<script type="text/javascript">
    function buttonize(cellvalue, options, rowobject) {
        return \'<input type="button" value="\' + cellvalue + \'" onclick="alert(\' + cellvalue + \')">\';
    }
</script>
')
?>


<b>Explanation:</b>
Formatters can attached to each individual column to easily format the content of the column. JqGrid
supports a number of predefined formtters, also custom formatters can be set.

<i>setFormatter</i>: Sets predefined formatter for individual column. Available formatters: integer, number,
currency, date, email, link, showlink, checkbox, select

<i>setCustomFormatter</i>: Use this method to attach a custom formatter to a column. The method expects the
name of the function which will handle the custom formatting. The following variables are passed to
the function:
    'cellvalue': The value to be formated (pure text).
    'options': Object { rowId: rid, colModel: cm} where rowId - is the id of the row and colModel is
               the object of the properties for this column retrieved from colModel array of jqGrid
    'rowobject': Row data represented in the format determined from datatype option.
</pre>