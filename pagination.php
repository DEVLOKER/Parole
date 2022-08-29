<?php
//define('records_per_page', 4);
class Pagination {
  
		private $total_rows;
		public $records_per_page = 5;
		private $range = 2;
		private $page;
		private $page_dom;
	
	 public function __construct($pd, $p){
		$this->page = $p; 
		$this->page_dom = $pd; 
	 }	
	
    public function paginate($num) {
		
		$this->total_rows = $num;


		echo "<nav><center><ul class=' pagination   '>"; //     background-color: red;

		if($this->page > 1){
			echo "<li class='page-item' ><a class='page-link' href='{$this->page_dom}' title='Aller a la premiere page.'>";
				//echo "<<";
			echo '<i class="fa fa-angle-double-left fa-1x" style="font-size:16px;"></i>';
			echo "</a></li>";
		}

		$total_pages = ceil( $this->total_rows / $this->records_per_page );
		$initial_num = $this->page - $this->range;
		$condition_limit_num = ($this->page + $this->range)  + 1;

		for ($x=$initial_num; $x<$condition_limit_num; $x++) {
			 
			if (($x > 0) && ($x <= $total_pages)) {
				if ($x == $this->page) echo "<li class='page-item active'><a class='page-link' href=\"#\">$x</a></li>";
				else 				   echo "<li class='page-item' ><a class='page-link' href='{$this->page_dom}?page=$x'>$x</a></li>";
				
			}
		}
		
		if($this->page<$total_pages){
			echo "<li class='page-item' ><a class='page-link' href='" .$this->page_dom . "?page={$total_pages}' title='Aller a la derniere page ({$total_pages}).'>";
				//echo ">>";
				//echo "<span class='fas angle-double-right fa-1x' ></span>";
				echo '<i class="fa fa-angle-double-right fa-1x" style="font-size:16px;"></i>';
			echo "</a></li>";
		}

		echo "</ul></center></nav>";		 
		 
    }
}	

?>