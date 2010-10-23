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
<b>Broncode:</b>
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


<b>Uitleg:</b>
Deze configuratie maakt het basis grid, met sorting en pagination.
Om de data van het grid op te halen wordt er een url op gegeven, dit kan door de setUrl functie aan te
spreken.
Het grid kan gevuld worden met twee soorten datatype: json (standaard) of xml.

<i>setCaption</i>: Zet de titel boven het grid

<i>addColumn</i>: Voegt een kolom toe aan het grid, op het kolom object kunnen extra parameters gezet worden
zoals setLabel.

<i>setUrl</i>: Zet de url die gebruikt wordt om de data op te halen. Standaard wordt er het datatype Json
verwacht dit kan veranderd worden door setDataType te veranderen naar xml.

<i>setLabel</i>: Zet label van het kolom.

<i>setAutoWidth</i>: Wanneer op true gezet wordt wordt het grid geforceerd om de breedte van zijn parent
(ouder) aan te nemen.

<i>setRowNum</i>: Zet het aantal rijen wat standaard wordt laten zien.

<i>setRowList</i>: Vult dropdown met aantal opties voor aantal rijen per pagina.

<i>setViewRecords</i>: Wanneer op true laat totaal aan rijen van de data set zien.

<i>setPager</i>: Zet de pager aan en zet id van het pager element. Je hoeft zelf geen element aan te maken dit
doet de helper voor jou.
</pre>