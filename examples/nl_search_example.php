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
<b>Broncode:</b>
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


<b>Uitleg:</b>
Bij deze configuratie wordt er een zoekbalk automatisch gegenereerd.
Zoek type kan er voor elke kolom gespecificeerd worden.

<i>setSearchType</i>: Zet zoek type voor de kolom. Zoek type kan gezet worden op: input (standaard), select,
of datepicker (datum kiezer).

<i>setSearchTerms</i>: Wanneer er voor optie select is gekozen bij setSearchType kan deze functie
gebruikt worden om een array met waarden aan te leveren om de selectbox te vullen.

<i>setSearchToolbar</i>: Zet zoekbalk aan of uit

<i>setSearchOnEnter</i>: Wanneer op true, wordt er alleen gezocht wanneer er op enter wordt gedrukt
wanneer op false wordt na het typen de zoek actie geactiveerd.
</pre>