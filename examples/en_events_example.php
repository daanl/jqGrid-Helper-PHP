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


<b>Explanation:</b>
The jqGrid helper supports all kinds of events. You can call a function or add any kind of javascript
to the event. Most events pass some arguments along, read the intellisense for each event to see which
variables are available during the event.

<i>onSortCol</i>: Triggered when sortbutton is clicked. Available variables are 'index' and 'sortorder'

<i>onSelectRow</i>: Triggered when row is selected. Available variables during the event are 'rowid' and
'status'. Status indicates if row is selected or unselected (only if multiselect is enabled)
</pre>