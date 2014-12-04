hyp-load-more
=============

<div id="main">
        	<!-- Template: desert-default/loop-page.php --><h2 class="page-title">Documentation</h2>
<p>This is the Load More documentation page. You will find instructions, help and any other project related information below.</p>
<hr>
            			        <script type="text/javascript">
		var currentUrl;
		function halLoad(target,url){
			if(currentUrl == url){
				document.getElementById(target).innerHTML = '';
				currentUrl = '';
				return;
			}
			else currentUrl = url;
			if(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
			else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");//For Ie5+Ie6
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) document.getElementById(target).innerHTML = xmlhttp.responseText;
			}
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
		}
		</script>
					<div id="ajax-loop" class="ajax-div"><!-- Template: desert-default/loop-mhs-documentation.php --><div id="post-122" class="ddt-post documentation hentry">
    <span class="link right"><a href="http://load-more.myhyperspace.com/122/basic-ajax-load/#respond" class="comments-link" title="Comment on Basic Ajax Load">No Comments</a> | <a class="post-edit-link" href="http://load-more.myhyperspace.com/wp-admin/post.php?post=122&amp;action=edit" title="Edit Post">Edit</a></span>
    <h3 class="post-title docs"><a href="http://load-more.myhyperspace.com/122/basic-ajax-load/">Basic Ajax Load</a></h3>
    <div class="post-content"><p>This is a simple Ajax loader example. It loads the file myphpfile.php immediately on pageload.</p>
<p><code class=" prettyprint"><!-- code block --><span class="pun">&lt;?</span><span class="pln">php</span><br><span class="pln">
$loader </span><span class="pun">=</span><span class="pln"> </span><span class="kwd">new</span><span class="pln"> </span><span class="typ">HypLoadMore</span><span class="pun">(</span><span class="pln">array</span><span class="pun">(</span><span class="str">'element_id'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'my-div-id'</span><span class="pun">,</span><span class="str">'path'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'myphpfile.php'</span><span class="pun">));</span><br><span class="pln">
$loader</span><span class="pun">-&gt;</span><span class="pln">load</span><span class="pun">();</span><br><span class="pln">
</span><span class="pun">?&gt;</span><br><span class="pln">
</span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">id</span><span class="pun">=</span><span class="atv">"my-div-id"</span><span class="tag">&gt;</span><span class="com">&lt;!-- This is where the loaded content will be printed --&gt;</span><span class="tag">&lt;/div&gt;</span></code></p>
</div>
</div><!-- /.ddt-post -->
<div id="post-114" class="ddt-post documentation hentry">
    <span class="link right"><a href="http://load-more.myhyperspace.com/114/wordpress/#respond" class="comments-link" title="Comment on WordPress">No Comments</a> | <a class="post-edit-link" href="http://load-more.myhyperspace.com/wp-admin/post.php?post=114&amp;action=edit" title="Edit Post">Edit</a></span>
    <h3 class="post-title docs"><a href="http://load-more.myhyperspace.com/114/wordpress/">WordPress</a></h3>
    <div class="post-content"><p>These classes are implemented as a WordPress plugin. Load More has no dependency on WordPress so you can easily remove the commented header block and it will work just fine.</p>
</div>
</div><!-- /.ddt-post -->
<div id="post-29" class="ddt-post documentation hentry">
    <span class="link right"><a href="http://load-more.myhyperspace.com/29/static-script/#respond" class="comments-link" title="Comment on Static Script">No Comments</a> | <a class="post-edit-link" href="http://load-more.myhyperspace.com/wp-admin/post.php?post=29&amp;action=edit" title="Edit Post">Edit</a></span>
    <h3 class="post-title docs"><a href="http://load-more.myhyperspace.com/29/static-script/">Static Script</a></h3>
    <div class="post-content"><p>This is an example of the static implementation. This example will be printed to the browser upon pageload. Load More will open the php file designated in the arguments and print that content to the browser as long as the autoload argument in set. Be sure to instantiate the dynamic class in the php file to be loaded. (See Dynamic Script)</p>
<p>The key to this system is its nested query string. The query string that is sent to the dynamically loaded file contains the commands which control the classes behavior. Within that is a nested query string which is the argument below called query. Add as many query variables as you want, in this example you could add age like this: 'gender=female&amp;age=40'. Use the get_query_array() function to access those values in your dynamically loaded php script.</p>
<p><code class=" prettyprint"><!-- code block --><span class="pun">&lt;?</span><span class="pln">php</span><br><span class="pln">
$args </span><span class="pun">=</span><span class="pln"> array</span><span class="pun">(</span><br><span class="pln">
	</span><span class="str">'autoload'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="lit">1</span><span class="pun">,</span><span class="pln">              </span><span class="com">//Load first batch</span><br><span class="pln">
	</span><span class="str">'class'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'button'</span><span class="pun">,</span><span class="pln">          </span><span class="com">//A classname for the button</span><br><span class="pln">
	</span><span class="str">'element_id'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'my-div-id'</span><span class="pun">,</span><span class="pln">  </span><span class="com">//Target element id</span><br><span class="pln">
	</span><span class="str">'limit'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="lit">10</span><span class="pun">,</span><span class="pln">                </span><span class="com">//Integer to pass as result limiter</span><br><span class="pln">
	</span><span class="str">'offset'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="lit">0</span><span class="pun">,</span><span class="pln">                </span><span class="com">//Integer representing start point</span><br><span class="pln">
	</span><span class="str">'path'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'myphpfile.php'</span><span class="pun">,</span><span class="pln">    </span><span class="com">//Path to your php file</span><br><span class="pln">
	</span><span class="str">'query'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'gender=female'</span><span class="pln">    </span><span class="com">//Nested query string for data to send</span><br><span class="pln">
</span><span class="pun">);</span><br><span class="pln">
$loader </span><span class="pun">=</span><span class="pln"> </span><span class="kwd">new</span><span class="pln"> </span><span class="typ">HypLoadMore</span><span class="pun">(</span><span class="pln">$args</span><span class="pun">);</span><br><span class="pln">
</span><span class="com">//$loader-&gt;load();//If autoload is off, load using this</span><br><span class="pln">
</span><span class="com">//$loader-&gt;load_more();//If autoload is off, show a load more button using this</span><br><span class="pln">
</span><span class="pun">?&gt;</span><br><span class="pln">
</span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">id</span><span class="pun">=</span><span class="atv">"my-div-id"</span><span class="tag">&gt;</span><br><span class="pln">
	</span><span class="tag">&lt;h4&gt;</span><span class="pln">My Data</span><span class="tag">&lt;/h4&gt;</span><br><span class="pln">
    </span><span class="com">&lt;!-- This is where the loaded content will be printed --&gt;</span><br><span class="pln">
</span><span class="tag">&lt;/div&gt;</span></code></p>
</div>
</div><!-- /.ddt-post -->
<div id="post-64" class="ddt-post documentation hentry">
    <span class="link right"><a href="http://load-more.myhyperspace.com/64/dynamic-script/#respond" class="comments-link" title="Comment on Dynamic Script">No Comments</a> | <a class="post-edit-link" href="http://load-more.myhyperspace.com/wp-admin/post.php?post=64&amp;action=edit" title="Edit Post">Edit</a></span>
    <h3 class="post-title docs"><a href="http://load-more.myhyperspace.com/64/dynamic-script/">Dynamic Script</a></h3>
    <div class="post-content"><p>This is the dynamic class, this should be located in the php file loaded by the static script. The class stores all the commands and the query sent to it by the static script so there is no need to pass any constructor arguments. Use the class accessors to get the data you need to run the sql query.</p>
<pre><code class=" prettyprint"><!-- code block --><span class="pun">&lt;?</span><span class="pln">php </span><span class="com">//Note: Not a working example, replace sql query with your own</span><span class="pln">
$printer </span><span class="pun">=</span><span class="pln"> </span><span class="kwd">new</span><span class="pln"> </span><span class="typ">HypLoadMoreDynamic</span><span class="pun">();</span><span class="pln">
$query </span><span class="pun">=</span><span class="pln"> $lazy_printer</span><span class="pun">-&gt;</span><span class="pln">get_query_array</span><span class="pun">();</span><span class="pln">
$limit </span><span class="pun">=</span><span class="pln"> $lazy_printer</span><span class="pun">-&gt;</span><span class="pln">get_limit</span><span class="pun">();</span><span class="pln">
$offset </span><span class="pun">=</span><span class="pln"> $lazy_printer</span><span class="pun">-&gt;</span><span class="pln">get_offset</span><span class="pun">();</span><span class="pln">
$limit_filter </span><span class="pun">=</span><span class="pln"> $offset </span><span class="pun">.</span><span class="pln"> </span><span class="str">','</span><span class="pln"> </span><span class="pun">.</span><span class="pln"> $limit</span><span class="pun">;</span><span class="pln">
$desired_gender </span><span class="pun">=</span><span class="pln"> $query</span><span class="pun">[</span><span class="str">'gender'</span><span class="pun">];</span><span class="pln">

</span><span class="com">//DB</span><span class="pln">
$dbc </span><span class="pun">=</span><span class="pln"> mysql_connect</span><span class="pun">(</span><span class="str">'localhost'</span><span class="pun">,</span><span class="str">'mydb'</span><span class="pun">,</span><span class="str">'pyAGQcyvm'</span><span class="pun">);</span><span class="pln">
mysql_select_db</span><span class="pun">(</span><span class="str">'mydb'</span><span class="pun">,</span><span class="pln"> $dbc</span><span class="pun">);</span><span class="pln">
$results </span><span class="pun">=</span><span class="pln"> mysql_query</span><span class="pun">(</span><span class="str">"
	SELECT * FROM mytable
	WHERE gender='$desired_gender'
	LIMIT $limit_filter
"</span><span class="pun">);</span><span class="pln">
mysql_close</span><span class="pun">(</span><span class="pln">$dbc</span><span class="pun">);</span><span class="pln">
</span><span class="pun">?&gt;</span><span class="pln">

</span><span class="pun">&lt;?</span><span class="pln">php </span><span class="kwd">if</span><span class="pun">(</span><span class="pln">$results</span><span class="pun">):</span><span class="pln"> </span><span class="pun">?&gt;</span><span class="pln">
	</span><span class="pun">&lt;?</span><span class="pln">php </span><span class="kwd">foreach</span><span class="pun">(</span><span class="pln">$results </span><span class="kwd">as</span><span class="pln"> $result</span><span class="pun">):</span><span class="pln"> </span><span class="pun">?&gt;</span><span class="pln">
        </span><span class="tag">&lt;p&gt;</span><span class="pun">&lt;?</span><span class="pln">php echo $result </span><span class="pun">?&gt;</span><span class="tag">&lt;/p&gt;</span><span class="pln">
    </span><span class="pun">&lt;?</span><span class="pln">php endforeach </span><span class="pun">?&gt;</span><span class="pln">
</span><span class="pun">&lt;?</span><span class="pln">php endif </span><span class="pun">?&gt;</span><span class="pln">
</span><span class="pun">&lt;?</span><span class="pln">php $lazy_printer</span><span class="pun">-&gt;</span><span class="pln">load_more</span><span class="pun">(</span><span class="pln">$results</span><span class="pun">)</span><span class="com">//Be sure to pass the result, this controls display of the button </span><span class="pun">?&gt;</span></code></pre>
</div>
</div><!-- /.ddt-post -->
<div id="post-71" class="ddt-post documentation hentry">
    <span class="link right"><a href="http://load-more.myhyperspace.com/71/function-reference/#respond" class="comments-link" title="Comment on Function Reference">No Comments</a> | <a class="post-edit-link" href="http://load-more.myhyperspace.com/wp-admin/post.php?post=71&amp;action=edit" title="Edit Post">Edit</a></span>
    <h3 class="post-title docs"><a href="http://load-more.myhyperspace.com/71/function-reference/">Function Reference</a></h3>
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
<p><code class=" prettyprint"><!-- code block --><span class="pln">$defaults </span><span class="pun">=</span><span class="pln"> array</span><span class="pun">(</span><br><span class="pln">
	</span><span class="str">'autoload'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'class'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">''</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'element_id'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'offset'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="lit">0</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'limit'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="lit">10</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'link'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'Load More'</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'path'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">,</span><br><span class="pln">
	</span><span class="str">'query'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><br><span class="pln">
</span><span class="pun">);</span></code></p>
</div>
</div><!-- /.ddt-post -->
</div>
        </div>
