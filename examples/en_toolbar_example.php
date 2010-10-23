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


<b>Explanation:</b>
A toolbar is added to the grid by using the setToolbar method. The id of the toolbar equals the id of
the grid, prefixed by t_. You can add buttons easily, or any other html elements for that matter, by
adding some javascript to the page.

<i>setToolbar</i>: Enables or disables toolbar.

<i>setToolparPosition</i>: Sets position of toolbar, top, bottom or both. When set to both, two
toolbars are generated (id top toolbar: t_ + grid id, id of bottom toolbar: tb_ + grid id).
</pre>