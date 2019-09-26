<!DOCTYPE html>
<?php
session_set_cookie_params(3600 * 24);
@session_start();
if (is_null($_SESSION['i'])) {
    $_SESSION['i'] = 0;
    $_SESSION['arr'] = array();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>LW1 WEB</title>
		<link rel="shortcut icon" href="images\logo.png" type="image/png">
		<link rel="stylesheet" href="css\style.css" type="text/css" />
		<script src="js/check.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
			<h1>Проверка попадания точки в график</h1>
			<h2>Пономаренко Елена Андреевна</h2>
			<h3>Группа: Р3202</h3>
			<h3>Вариант: 202016</h3>
		</header>
		<div class="content">
			<div class="leftSidebar">
				<form action="script.php" method="get" target="result">
					<p><b>Выберите значение R:</b>
						<p><input type="radio" name="r" value="1" checked> 1
						<input type="radio" name="r" value="2"> 2
						<input type="radio" name="r" value="3"> 3
						<input type="radio" name="r" value="4"> 4
						<input type="radio" name="r" value="5"> 5</p>
					</p>
					<p><b>Введите значение X:</b>
						<p><input id="text_x" type="text" size="15" name="x" placeholder="от -3 до 5"></p>
					</p>
					<p><b>Выберите значение Y:</b>
						<div class="choose_y">
							<table>
								<tr>
									<td><input type="checkbox" id="y1" name="y" value="-4"> -4</td>
									<td><input type="checkbox" id="y2" name="y" value="-3"> -3</td>
									<td><input type="checkbox" id="y3" name="y" value="-2"> -2</td>
								</tr>
								<tr>
									<td><input type="checkbox" id="y4" name="y" value="-1"> -1</td>
									<td><input type="checkbox" id="y5" name="y" value="0"> 0</td>
									<td><input type="checkbox" id="y6" name="y" value="1"> 1</td>
								</tr>
								<tr>
									<td><input type="checkbox" id="y7" name="y" value="2"> 2</td>
									<td><input type="checkbox" id="y8" name="y" value="3"> 3</td>
									<td><input type="checkbox" id="y9" name="y" value="4"> 4</td>
								</tr>
							</table>
						</div>
					</p>
					<div class="buttons">
						<table>
							<tr>
								<td>
									<input type="button" class="check_button" value=" Проверить " OnClick="check()">
								</td>
								<td>
									<p><input type="submit" class="submit_button" id="submit" value=" Результат " disabled></p>
								</td>
							</tr>
						</table>
					</div>
					<p id="error"></p>
				</form>
			</div>
			<div class="rightSidebar">
				<div id="frame" class="container">
					<iframe name = "result" height="550"></iframe>
				</div>
			</div>
		</div>
		<footer>Copyright © Lumenebris, 2019</footer>
    </body>
</html>