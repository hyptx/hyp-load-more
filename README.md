hyp-load-more
=============
![ScreenShot](https://lh6.googleusercontent.com/-D3_O5cAnjwM/VH_t4gDry0I/AAAAAAAAARU/7-4ZSmrSR7k/w0-h0-no/ss.png)

##Basic Ajax Load

This is a simple Ajax loader example. It loads the file myphpfile.php immediately on pageload.
```php
<?php
$loader = new HypLoadMore(array('element_id' => 'my-div-id','path' => 'myphpfile.php'));
$loader->load();
?>
<div id="my-div-id"><!-- This is where the loaded content will be printed --></div>
```

##WordPress

These classes are implemented as a WordPress plugin. Load More has no dependency on WordPress so you can easily remove the commented header block and it will work just fine.

##Static Script

This is an example of the static implementation. This example will be printed to the browser upon pageload. Load More will open the php file designated in the arguments and print that content to the browser as long as the autoload argument in set. Be sure to instantiate the dynamic class in the php file to be loaded. (See Dynamic Script)

The key to this system is its nested query string. The query string that is sent to the dynamically loaded file contains the commands which control the classes behavior. Within that is a nested query string which is the argument below called query. Add as many query variables as you want, in this example you could add age like this: 'gender=female&age=40'. Use the get_query_array() function to access those values in your dynamically loaded php script.

```php
<?php
$args = array(
	'autoload' => 1,              //Load first batch
	'class' => 'button',          //A classname for the button
	'element_id' => 'my-div-id',  //Target element id
	'limit' => 10,                //Integer to pass as result limiter
	'offset' => 0,                //Integer representing start point
	'path' => 'myphpfile.php',    //Path to your php file
	'query' => 'gender=female'    //Nested query string for data to send
);
$loader = new HypLoadMore($args);
//$loader->load();//If autoload is off, load using this
//$loader->load_more();//If autoload is off, show a load more button using this
?>
<div id="my-div-id">
	<h4>My Data</h4>
    <!-- This is where the loaded content will be printed -->
</div>
```
##Dynamic Script

This is the dynamic class, this should be located in the php file loaded by the static script. The class stores all the commands and the query sent to it by the static script so there is no need to pass any constructor arguments. Use the class accessors to get the data you need to run the sql query.

```php
<?php //Note: Not a working example, replace sql query with your own
$printer = new HypLoadMoreDynamic();
$query = $lazy_printer->get_query_array();
$limit = $lazy_printer->get_limit();
$offset = $lazy_printer->get_offset();
$limit_filter = $offset . ',' . $limit;
$desired_gender = $query['gender'];

//DB
$dbc = mysql_connect('localhost','mydb','pyAGQcyvm');
mysql_select_db('mydb', $dbc);
$results = mysql_query("
	SELECT * FROM mytable
	WHERE gender='$desired_gender'
	LIMIT $limit_filter
");
mysql_close($dbc);
?>

<?php if($results): ?>
	<?php foreach($results as $result): ?>
        <p><?php echo $result ?></p>
    <?php endforeach ?>
<?php endif ?>
<?php $lazy_printer->load_more($results)//Be sure to pass the result, this controls display of the button ?>
```

##Function Reference

<div class="post-content"><p><strong>Accessors</strong><br>Use to get the data sent by the static script</p>
<ul>
<li>get_autoload()</li>
<li>get_commands() </li>
<li>get_commands_array() </li>
<li>get_element_id()</li>
<li>get_limit()</li>
<li>get_link()</li>
<li>get_offset() </li>
<li>get_path() </li>
<li>get_query() </li>
<li>get_query_array()</li>
</ul>
<p><strong>Public Methods</strong></p>
<ul>
<li>load()</li>
<li>load_more() </li>
</ul>
<p><strong>Defaults</strong><br>These are the constructor default values, the dynamic version unsets the autoload property.</p>

```php
$defaults = array(
	'autoload' => false,
	'class' => '',
	'element_id' => false,
	'offset' => 0,
	'limit' => 10,
	'link' => 'Load More',
	'path' => false,
	'query' => false
);
```
