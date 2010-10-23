<h2>Multiselect</h2>

<?php
echo Grid::create('myFirstGrid')
		->addColumn(Column::create('film_id'))
		->addColumn(Column::create('title'))
		->addColumn(Column::create('description'))
		->addColumn(Column::create('last_update'))
		->setCaption('My First grid')
		->setUrl('datafeed.php')
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setWidth(840)
		->setPagerPos('center')
		->setPager('mypager')
 		->setMultiSelect(true)
    	->setMultiBoxOnly(false)
    	->setMultiSelectWidth(20)
?>

<pre>
<b>Source:</b>
<?php echo htmlentities('<?php echo Grid::create("myFirstGrid")
		->addColumn(Column::create("film_id"))
		->addColumn(Column::create("title"))
		->addColumn(Column::create("description"))
		->addColumn(Column::create("last_update"))
		->setCaption("My First grid")
		->setUrl("datafeed.php")
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setWidth(840)
		->setPagerPos("center")
		->setPager("mypager")
 		->setMultiSelect(true)
    	->setMultiBoxOnly(false)
    	->setMultiSelectWidth(20)
?>
')
?>


<b>Explanation</b>
JqGrid supports selecting multiple selection of rows. By using the setMultiSelect method multiselect
is enabled. A column containing checkboxes is automatically added.


<i>setMultiSelect</i>: Enables or disables multiple selection of rows (default: false).

<i>setMultiBoxOnly</i>: By enabling this option, users can only select rows by using the checkbox.
When set to false (default), the entire row can be clicked to select the row.

<i>setMultiSelectWidth</i>: Sets the width of the column containing the checkboxes (default: 20).
</pre>