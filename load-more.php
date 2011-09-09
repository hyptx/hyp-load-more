<?php
/*
Plugin Name: HypLoadMore
Plugin URI: http://hyperspatial.com
Description: An ajax content loader system
Version: 1.0
Author: Adam J Nowak
Author URI: http://hyperspatial.com
License: GPL2
*/

class HypLoadMore{
	protected static $constructed;
	protected $autoload,$class,$element_id,$offset,$limit,$path,$query,$query_array,$commands,$commands_array;
	public function __construct($args = ''){
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
		//Store Vars
		$commands_array = $this->parse_args($args,$defaults);
		extract($commands_array);
		foreach($commands_array as $key => $value){ $this->{$key} = $value; }
		//Commands
		$this->commands_array = $commands_array;
		$this->commands = http_build_query($commands_array);
		//Query Array
		parse_str($this->query,$query_array);
		$this->query_array = $query_array;
		//Print and Load
		if(!self::$constructed) $this->print_javascript();
		if($autoload) $this->load();
		self::$constructed ++;
	}
	/* ~~~~~~~~~~~~~~~~~~~ Private Methods ~~~~~~~~~~~~~~~~~~~ */
	
	protected function parse_args($args,$defaults = ''){
    	if(is_object($args)) $r = get_object_vars($args);
    	elseif(is_array($args)) $r =& $args;
       	else $this->parse_string($args,$r);
        if(is_array($defaults)) return array_merge($defaults,$r);
        return $r;
    }
	protected function parse_string($string, &$array) {
    	parse_str($string,$array);
		if(get_magic_quotes_gpc()) $array = stripslashes_deep($array);
     	return $array;
  	}
	private function print_javascript(){?>
        <script type="text/javascript">
		var currentUrl;
		function hlmLoad(target,url){
			if(currentUrl == url){
				document.getElementById(target).innerHTML = '';
				currentUrl = '';
				return;
			}
			else currentUrl = url;
			if(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
			else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = function(){ 
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) document.getElementById(target).innerHTML += xmlhttp.responseText;
			}
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
		}
		</script>
		<?php
	}	
	
	/* ~~~~~~~~~~~~~~~~~~~ Public Methods ~~~~~~~~~~~~~~~~~~~ */
	
	public function get_autoload(){ return $this->autoload; }
	public function get_commands(){ return $this->commands; }
	public function get_commands_array(){ return $this->commands_array; }
	public function get_element_id(){ return $this->element_id; }
	public function get_limit(){ return $this->limit; }
	public function get_link(){ return $this->link; }
	public function get_offset(){ return $this->offset; }
	public function get_path(){ return $this->path; }
	public function get_query(){ return $this->query; }
	public function get_query_array(){ return $this->query_array; }
	//Loader
	public function load(){
		$commands = $this->commands;
		if($commands) $commands = '?' . $commands; 
		?>
		<script type="text/javascript">hlmLoad('<?php echo $this->element_id ?>','<?php echo $this->path . $commands ?>');</script>
		<?php
	}
}


class HypLoadMoreDynamic extends HypLoadMore{
	public function __construct(){
		$defaults = array(
			'class' => '',
			'element_id' => false,
			'offset' => 0,
			'limit' => 10,
			'link' => 'Load More',
			'path' => false,
			'query' => false
		);
		unset($_GET['autoload']);
		//Store Vars
		$commands_array = $this->parse_args($_GET,$defaults);
		extract($commands_array);
		foreach($commands_array as $key => $value){ $this->{$key} = $value; }
		//Commands
		$this->commands_array = $commands_array;
		$this->commands = http_build_query($commands_array);
		//Query Array
		parse_str($this->query,$query_array);
		$this->query_array = $query_array;
		self::$constructed ++;
	}
	/* ~~~~~~~~~~~~~~~~~~~ Public Methods ~~~~~~~~~~~~~~~~~~~ */
	
	public function load_more($results){
		if(!$results) return;
		if(count($results) < $this->limit) return;
		$this->commands_array['offset'] = $this->commands_array['offset'] + $this->limit;
		$this->commands = http_build_query($this->commands_array);
		$commands = $this->commands;
		if($commands) $commands = '?' . $commands; ?>
        
		<span class="hlm-load-more <?php echo $this->class ?>" onclick="hlmLoad('<?php echo $this->element_id ?>','<?php echo $this->path . $commands ?>'); this.parentNode.removeChild(this);"><?php echo $this->link ?></span>
		<?php
	}
}
?>