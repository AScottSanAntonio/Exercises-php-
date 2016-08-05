<?php  
	class Rectangle
	{
		public $width;
		public $height;


		public function __construct($width, $height)
		{
			$this->width = $width;
			$this->height = $height;
		}
		public function area()
		{
			return $this->width * $this->height;
		}
	}
	$bob = new Rectangle(100, 100);
	echo "The rectangle's area is: " . $bob->area().PHP_EOL ;
?>