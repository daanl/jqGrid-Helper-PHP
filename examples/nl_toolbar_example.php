<h2>Toolbar</h2>

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
		->setToolbar(true)
		->setToolbarPosition('bottom')
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#t_myFirstGrid")
            .append('<input type="button" value="Click Me" onclick="alert(\'Hi\');"/>');
    });
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
		->setToolbar(true)
		->setToolbarPosition("bottom")
?>
')
?>

&lt;script type=&quot;text/javascript&quot;&gt;
    $(document).ready(function () {
        $(&quot;#t_myFirstGrid&quot;)
            .append('&lt;input type=&quot;button&quot; value=&quot;Click Me&quot; onclick=&quot;alert(\'Hi\');&quot;/&gt;');
    });
&lt;/script&gt;


<b>Uitleg:</b>
De toolbar wordt toegevoegd wanneer setToolbar op true staat. De id van de toolbar is gelijk aan de de id van het grid maar
met een "t_" er voor. Zodat je makkelijk met javascript extra buttons kan aanmaken.

<i>setToolbar</i>: Zet toolbar aan of uit

<i>setToolparPosition</i>: Zet de positie van de toolbar: top (boven), bottom (onder) or both (beide).
Wanneer op both (beide) wordt gezet worden er twee toolbarsWhen set to both, two gegenereerd een met id
t_ + grid id voor boven en ander met tb_ + grid id voor onder.
</pre>