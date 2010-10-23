<h2>Basic example</h2>

<?php
echo Grid::create('myFirstGrid')
		->addColumn(Column::create('film_id'))
		->addColumn(Column::create('title')
			->setLabel('Title'))
		->setUrl('datafeed.php')
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setPager('mypager')
		->setCaption('My first grid')
		->setWidth(840)

?>


<pre>
<b>Source:</b>
<?php echo htmlentities("<?php echo Grid::create('myFirstGrid')
		->addColumn(Column::create('film_id'))
		->addColumn(Column::create('title')
			->setLabel('Title'))
		->setUrl('datafeed.php')
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setPager('mypager')
		->setCaption('My first grid')
		->setWidth(840)
?>")
?>


<b>Explanation:</b>
This configuration renders a basic grid, with ordering and paging enabled. To retrieve data the grid
will send a request to the specified url (setUrl). The grid expects a json (default) or xml response
from the server to fill the grid.

<i>setCaption</i>: Sets the grid title.

<i>addColumn</i>: Adds a column to the grid, the column class contains additional properties
which can be set fluently, like setLabel.

<i>setUrl</i> :Sets the url which is used by the grid to request data. Default is a json request,
this can changed with the the setDataType method.

<i>setLabel:</i>: Sets the column header text.

<i>setAutoWidth</i>: When set to true will force the grid to fit the width of the parent element.

<i>setRowNum</i>: Sets the number of rows displayed initially.

<i>setRowList</i>: Fills the dropdownlist in the pager which controls the number of rows per page.

<i>setViewRecords</i>: When set to true displays the total number of rows in the dataset.


<i>setPager</i>: Enables the pager, id of the pagerelement has to be specified. You don't have to
create a pager element yourself, this is created for you.
</pre>