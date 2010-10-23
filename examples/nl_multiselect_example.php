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
<b>Broncode:</b>
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


<b>Uitleg</b>
JqGrid ondersteunt selectie van meerdere rijen. Gebruik de functie setMultiSelect om dit aan te zetten.
Een kolom met meerdere checkboxen wordt automatisch toegevoegd.

<i>setMultiSelect</i>: Zet multiselect aan of uit (standaard uit).

<i>setMultiBoxOnly</i>: Wanneer dit op true wordt gezet kan de checkbox alleen aangevinkt worden wanneer er
op de checkbox zelf geklikt wordt, wanneer dit uitstaat kan er gewoon op een rij geklikt worden om de
checkbox aan te vinken.

<i>setMultiSelectWidth</i>: Zet de breedte van de multiselect kolom (standaard: 20).
</pre>