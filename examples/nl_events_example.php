<h2>Events</h2>


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
		->onSortCol("alert('Sort direction: ' + sortorder)")
		->onSelectRow("onRowSelected(rowid, status)")
?>

<script type="text/javascript">
    function onRowSelected(rowid, status) {
        alert('This row has id: ' + rowid);
    }
</script>

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
		->onSortCol("alert("Sort direction: " + sortorder)")
		->onSelectRow("onRowSelected(rowid, status)")
?>

<script type="text/javascript">
    function onRowSelected(rowid, status) {
        alert(\'This row has id: \' + rowid);
    }
</script>
')
?>


<b>Uitleg:</b>
De jqGrid helper ondersteunt alle soorten events. Waar bij je javascript of een javascript
functie kan afvuren.
Bij de meeste events zijn er een standaard aantal variabelen beschikbaar, voor elk event
kan je ze zien met intellisense.

<i>onSortCol</i>: Wordt afgevuurd wanneer er gesorteerd wordt. Beschikbare variabelen zijn
 'index' en 'sortorder'

<i>onSelectRow</i>: Wordt afgevuurd wanneer een rij wordt geselecteerd.
Beschikbare variabelen zijn 'rowid' en
'status'. Status geeft aan of een rij is geselecteerd of niet geselecteerd (Alleen
 beschikbaar wanneer multiselect is aan staat)
</pre>