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
<b>Broncode:</b>
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


<b>Uitleg:</b>
Voor elke kolom kan je een formatter op geven waarbij je de inhoud van de kolom makkelijk kan manipuleren.
JqGrid heeft een aantal voor gedefineerde formatters, je kan ook een zelf gemaakte formatter
(javascript funtie) opgeven.

<i>setFormatter</i>: Zet een formatter op een kolom. Standaard formatters zijn: integer, number,
currency, date, email, link, showlink, checkbox, select

<i>setCustomFormatter</i>: Zet een zelf gemaakte formatter op een kolom dit is een javascript functie.
De functie setCustomFormatter verwacht een naam van de javascript functie
welke de custom formattering afhandelt. De volgende variabelen zijn standaard beschikbaar voor een
formatter:
    'cellvalue': De waarde van de cell
    'options': Object { rowId: rid, colModel: cm} rowId - is het id van de rij en colModel is
               het object van de kolom specifieke instellen
    'rowobject': Rij data.
</pre>