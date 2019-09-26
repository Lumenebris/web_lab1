<!DOCTYPE html>
<html>
<head>
	<title>Результат</title>
  	<meta charset="utf-8">
	<link rel="stylesheet" href="css\svg.css" type="text/css" />
	<link rel="stylesheet" href="css\script_style.css" type="text/css" />
</head>
<body>
<?php
	session_start();
	$start = microtime(true);					
	
	$flag = $_GET['submit'];
	$x = (float) $_GET['x'];
	$y = (int) $_GET['y'];
	$r = (int) $_GET['r'];
	
	makeAnswer($flag, $x, $y, $r, $start);
	
	function makeAnswer($flag, $x, $y, $r, $start) {
		if ($flag != disabled) {
			if (!validate($x, $y, $r)) {
				array_push($_SESSION['arr'], false);
			} else {
				if (check_zone($x, $y, $r))
					$check = true;
				else
					$check = false;
				$_SESSION['i']++;
				$n = $_SESSION['i'];
				$time = round((microtime(true) - $start) * 1000, 3);
				$currentTime = date("H:i:s", strtotime('+3 hour'));
				array_push($_SESSION['arr'], array($n, $x, $y, $r, $check, $currentTime, $time));
			}
			makeTable(10);
		}
	}
	
	function validate($x_arg, $y_arg, $r_arg) {
		if (!(is_numeric($x_arg) && is_numeric($y_arg) && is_numeric($r_arg))) return false;
		$y_values = array(-4, -3, -2, -1, 0, 1, 2, 3, 4);
		$r_values = array(1, 2, 3, 4, 5);
		if (!in_array($y_arg, $y_values)) return false;
		if ($x_arg < -3 || $x_arg > 5) return false;
		if (!in_array($r_arg, $r_values)) return false;
		return true;
	}
	
	function check_zone($x, $y, $r) {
		$first_zone = ($x >= (-$r / 2) & $x <= 0 & $y >= -$r & $y <= 0);
		$second_zone = ($x >= 0 & $x <= ($r/2) & $y >= 0 & $y <= (($r / 2) - $x));
		$third_zone = ((pow($x, 2) + pow($y, 2)<=(pow($r / 2, 2))) & $y <= 0 & $x >= 0);
	    return $first_zone || $second_zone || $third_zone;
	}
	
	function makeTable($limit) {
		echo "<table class=\"results\">";
		echo "<tr> <th>N</th> <th>X</th> <th>Y</th> <th>R</th> <th><b>Результат</b></th> <th>Время</th> <th>Время работы скрипта </th>";
		while (count($_SESSION['arr']) >= $limit) array_shift($_SESSION['arr']);
		foreach ($_SESSION['arr'] as $item) {
			if (count($item) == 1)
				echo "<tr> <td colspan='8'><b>Неверные аргументы</b></td> </tr>";
			else {
				$result = $item[4] ? "Попадание" : "Промах";
				echo "<tr> <td>$item[0]</td> <td>$item[1]</td> <td>$item[2]</td> <td>$item[3]</td> <td><b>$result</b></td> <td>$item[5]</td>  <td>$item[6]  мс</td>";
			}
		}
		echo "</table> <br>";
	}
	
?>
				
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" viewBox="0 0 180 180" width="400" height="410">
		<!-- Создание шаблонов графических объектов -->
							<defs>
								<!-- Координатная сетка, закрывающая часть окружности -->
								<g id="grid-front">
									<?php
										for ($i = 1; $i <= 12; $i++) {
											for ($j = 1; $j <= 12; $j++) {
												if ($j == 7 || $j == 8) {
													if ($i == 7 || $i == 8);
													else {
														echo "<rect x=\"{$i}0\" y=\"{$j}0\" width=\"10\" height=\"10\" id=\"square-{$i}_{$j}\"/>";
													}
												}
												else {
														echo "<rect x=\"{$i}0\" y=\"{$j}0\" width=\"10\" height=\"10\" id=\"square-{$i}_{$j}\"/>";
												}
											}
										}
									?>
								</g>
								<!-- Координатная сетка, не закрывающая часть окружности -->
								<g id="grid-back">
									<rect x="70" y="70" width="10" height="10" id="square-7_7"/>
									<rect x="80" y="70" width="10" height="10" id="square-7_8"/>
									<rect x="70" y="80" width="10" height="10" id="square-8_7"/>
									<rect x="80" y="80" width="10" height="10" id="square-8_8"/>
								</g>
								<!-- Область. Окружность -->
								<circle cx="70" cy="70" r="20" id="region-circle"/>";
								<!-- Область. Прямоугольник -->
								<rect x="50" y="70" width="20" height="40" id="region-rectangle"/>
								<!-- Область. Треугольник -->
								<polygon points="70 70, 70 50, 90 70" id="region-triangle"/>
								<!-- Метки на координатных осях -->
								<g id="labels">
									<?php
										echo "<text id=\"x1\" x=\"72\" y=\"31.7\">"; echo $r; echo "</text>";
										echo "<text id=\"x2\" x=\"72\" y=\"51.7\">"; echo $r/2; echo "</text>";
										echo "<text id=\"x3\" x=\"72\" y=\"91.7\">"; echo -$r/2; echo "</text>";
										echo "<text id=\"x4\" x=\"72\" y=\"111.7\">"; echo -$r; echo "</text>";
										echo "<text id=\"simv1\" x=\"72\" y=\"1.7\">"; echo y; echo "</text>";
										echo "<text id=\"y1\" x=\"28\" y=\"68\">"; echo -$r; echo "</text>";
										echo "<text id=\"y2\" x=\"45.5\" y=\"68\">"; echo -$r/2; echo "</text>";
										echo "<text id=\"y3\" x=\"87.5\" y=\"68\">"; echo $r/2; echo "</text>";
										echo "<text id=\"y4\" x=\"110\" y=\"68\">"; echo $r; echo "</text>";
										echo "<text id=\"simv2\" x=\"140\" y=\"68\">"; echo x; echo "</text>";
									?>
								</g>
								<!-- Ось X -->
								<line x1="0" x2="140" y1="70" y2="70" id="x-axis"/>
								<line x1="140" x2="137" y1="70" y2="72" id ="x-pointer-1"/>
								<line x1="140" x2="137" y1="70" y2="68" id ="x-pointer-2"/>
								<!-- Ось Y -->
								<line x1="70" x2="70" y1="0" y2="140" id="y-axis"/>
								<line x1="70" x2="68" y1="0" y2="3" id ="y-pointer-1"/>
								<line x1="70" x2="72" y1="0" y2="3" id ="y-pointer-2"/>
								<!-- Задаваемые точки и их координаты -->
								<?php
									$dx = 10; $dy = 10;
									$x0 = 70; $y0 = 70;
									for ($i = 0; $i < count($y); $i++) {
										$X = $x0 + $x*$dx*4/$r;
										$Y = $y0 - $y[$i]*$dy*4/$r;
										echo "<circle cx=\"{$X}\" cy=\"{$Y}\" r=\"1.5\" id=\"point_{$i}\"/>";
										echo "<text id=\"coordinates_{$i}\" x=\""; echo $X + 2.5; echo "\" y=\""; echo $Y + 2.0; echo "\">({$x}; {$y[$i]})</text>";
									}
								?>
							</defs>
							<!-- Отображение графических объектов -->
							<!-- Координатная сетка, закрывающая часть окружности -->
							<g><use class="grid" xlink:href="#grid-back"></use></g>
							<!-- Область. Окружность -->
							<g><use xlink:href="#region-circle" class="region"></use></g>
							<!-- Координатная сетка, не закрывающая часть окружности -->
							<g><use class="grid" xlink:href="#grid-front"></use></g>
							<!-- Область. Прямоугольник -->
							<g><use xlink:href="#region-rectangle" class="region"></use></g>
							<!-- Область. Треугольник -->
							<g><use xlink:href="#region-triangle" class="region"></use></g>
							<!-- Метки на координатных осях -->
							<g><use xlink:href="#labels" class="text"></use></g>
							<!-- Ось X -->
							<g><use xlink:href="#x-axis" class="axis"></use></g>
							<g><use xlink:href="#x-pointer-1" class="axis"></use></g>
							<g><use xlink:href="#x-pointer-2" class="axis"></use></g>
							<!-- Ось Y -->
							<g><use xlink:href="#y-axis" class="axis"></use></g>
							<g><use xlink:href="#y-pointer-1" class="axis"></use></g>
							<g><use xlink:href="#y-pointer-2" class="axis"></use></g>
							<!-- Задаваемые точки и их координаты -->
							<?php
								for ($i = 0; $i < count($y); $i++) {
									echo "<g><use xlink:href=\"#point_{$i}\" class=\"point\"></use></g>";
									echo "<g><use xlink:href=\"#coordinates_{$i}\" class=\"coordinates\"></use></g>";
								}
							?>
						</svg>
</body>
</html>