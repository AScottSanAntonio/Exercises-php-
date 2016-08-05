<?php  
	require_once 'rectangle.php';

	class Square extends Rectangle
	{
	
		public function perimeter()
		{
			return ($this->width * 2) + ($this->height * 2);
		}
	}
	$bob = new Square(100, 100);
	echo "The square's perimeter is: " . $bob->perimeter().PHP_EOL ;
?>