<?php
/*
Plugin Name: HypLoadMore
Plugin URI: https://github.com/hyptx/hyp-load-more
Description: An ajax content loading system for adding content dynamically
Version: 1.0
Author: Adam J Nowak
Author URI: http://hyperspatial.com
License: GPL2
*/

/* HypLoadMore Class - siri boo moo
*  Instantiate in the static php file */
class HypLoadMore{
	protected static $constructed;
	protected $autoload,$class,$element_id,$offset,$limit,$link,$path,$query,$query_array,$commands,$commands_array;
	public function __construct($args = ''){
		$defaults = array('autoload' => false,'class' => '','element_id' => false,'offset' => 0,'limit' => 10,'link' => 'Load More','path' => false,'query' => false);
		//Store properties
		$commands_array = $this->parse_args($args,$defaults);
		extract($commands_array);
		foreach($commands_array as $key => $value){ $this->{$key} = $value; }
		//Store reference arrays
		$this->commands_array = $commands_array;
		$this->commands = '?' . http_build_query($commands_array);
		parse_str($this->query,$query_array);
		$this->query_array = $query_array;
		//Print JS and load
		if(!self::$constructed) $this->print_javascript();
		if($autoload) $this->load();
		self::$constructed ++;
	}
	/* ~~~~~~~~~~~~~~~~~~~ Class Methods ~~~~~~~~~~~~~~~~~~~ */
	
	protected function parse_args($args,$defaults = ''){
    	if(is_object($args)) $r = get_object_vars($args);
    	elseif(is_array($args)) $r =& $args;
       	else $this->parse_string($args,$r);
        if(is_array($defaults)) return array_merge($defaults,$r);
        return $r;
    }
	protected function parse_string($string, &$array){
    	parse_str($string,$array);
		if(get_magic_quotes_gpc()) $array = stripslashes_deep($array);
     	return $array;
  	}
	private function print_javascript(){?>
        <script type="text/javascript">var currentUrl;function hlmLoad(target,url){if(currentUrl==url){document.getElementById(target).innerHTML='';currentUrl='';return}else currentUrl=url;if(window.XMLHttpRequest)xmlhttp=new XMLHttpRequest();else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");xmlhttp.onreadystatechange=function(){if(xmlhttp.readyState==4&&xmlhttp.status==200)document.getElementById(target).innerHTML+=xmlhttp.responseText};xmlhttp.open("GET",url,true);xmlhttp.send()}</script>
		<?php
	}	
	/* ~~~~~~~~~~~~~~~~~~~ Accessors ~~~~~~~~~~~~~~~~~~~ */
	
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
	
	/* ~~~~~~~~~~~~~~~~~~~ Loader Methods ~~~~~~~~~~~~~~~~~~~ */
	
	public function load(){?>
		<script type="text/javascript">hlmLoad('<?php echo $this->element_id ?>','<?php echo $this->path . $this->commands ?>');</script>
		<?php
	}
	public function load_more(){?>
		<span class="hlm-load-more <?php echo $this->class ?>" onclick="hlmLoad('<?php echo $this->element_id ?>','<?php echo $this->path . $this->commands ?>'); this.parentNode.removeChild(this);"><?php echo $this->link ?></span>
		<?php
	}
}

/* HypLoadMoreDynamic Class
*  Instantiate in the dynamically loaded php file */
class HypLoadMoreDynamic extends HypLoadMore{
	public function __construct(){
		$defaults = array('class' => '','element_id' => false,'offset' => 0,'limit' => 10,'link' => 'Load More','path' => false,'query' => false);
		unset($_GET['autoload']);
		//Store properties
		$commands_array = $this->parse_args($_GET,$defaults);
		extract($commands_array);
		foreach($commands_array as $key => $value){ $this->{$key} = $value; }
		//Store reference arrays
		$this->commands_array = $commands_array;
		$this->commands = '?' . http_build_query($commands_array);
		parse_str($this->query,$query_array);
		$this->query_array = $query_array;
		self::$constructed ++;
	}
	/* ~~~~~~~~~~~~~~~~~~~ Load More Method Overwrite ~~~~~~~~~~~~~~~~~~~ */
	
	public function load_more($results){
		if(!$results || count($results) < $this->limit) return;
		$this->commands_array['offset'] = $this->commands_array['offset'] + $this->limit; //Shift offset for next load
		$this->commands = '?' . http_build_query($this->commands_array); ?>
		<span class="hlm-load-more <?php echo $this->class ?>" onclick="hlmLoad('<?php echo $this->element_id ?>','<?php echo $this->path . $this->commands ?>'); this.parentNode.removeChild(this);"><?php echo $this->link ?></span>
		<?php
	}
}
?>
