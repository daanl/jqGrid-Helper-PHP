<h2>Search</h2>

<?php
echo Grid::create('myFirstGrid')
		->addColumn(Column::create('film_id'))
		->addColumn(Column::create('title')
			->setSearchType('select')
			->setSearchTerms(array(	'ACADEMY DINOSAUR' => 'ACADEMY DINOSAUR',
									'ACE GOLDFINGER' => 'ACE GOLDFINGER',
									'ALABAMA DEVIL' => 'ALABAMA DEVIL')))
		->addColumn(Column::create('description')
			->setLabel('Description')
			->setAlign('center')
			->setSearch(true))
		->addColumn(Column::create('last_update')
			->setSearchType('datepicker')
			->setSearchDateFormat('yy-mm-dd'))
		->setCaption('My First grid')
		->setUrl('datafeed.php')
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setWidth(840)
		->setPagerPos('center')
		->setPager('mypager')
		->setSearchToolbar(true)
		->setSearchOnEnter(false)
?>

<pre>
<b>Source:</b>
<?php echo htmlentities("<?php echo Grid::create('myFirstGrid')
		->addColumn(Column::create('film_id'))
		->addColumn(Column::create('title')
			->setSearchType('select')
			->setSearchTerms(array(
					'ACADEMY DINOSAUR' => 'ACADEMY DINOSAUR',
					'ACE GOLDFINGER' => 'ACE GOLDFINGER',
					'ALABAMA DEVIL' => 'ALABAMA DEVIL')))
		->addColumn(Column::create('description')
			->setLabel('Description')
			->setAlign('center')
			->setSearch(true))
		->addColumn(Column::create('last_update')
			->setSearchType('datepicker')
			->setSearchDateFormat('yy-mm-dd'))
		->setCaption('My First grid')
		->setUrl('datafeed.php')
		->setRowNum(10)
		->setRowList(array(10, 20, 30))
		->setWidth(840)
		->setPagerPos('center')
		->setPager('mypager')
		->setSearchToolbar(true)
		->setSearchOnEnter(false)
?>")
?>


<b>Explanation:</b>
This configuration demonstrates toolbar searching. A searchtype can be specified for each column.


<i>setSearchType</i>: Sets searchtype for a column. Searchtype can be set to input (default), select or
datepicker.

<i>setSearchTerms</i>: When searchtype is set to select, this function is used to the fill the selectbox.
The function takes a collection of strings as selectoptions.

<i>setSearchToolbar</i>: Enables or disables toolbar searching.

<i>setSearchOnEnter</i>: When set to true, search is executed when the user hits enter. When set to false
search is executed after the user stops typing.
</pre>