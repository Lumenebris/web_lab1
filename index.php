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
			<div class="upperSidebar">
				<form action="script.php" method="get" target="result">
					<div class="chooseR">
						<p class="heading"><b>Выберите значение R:</b>
							<p><input type="radio" name="r" value="1" checked> 1
							<input type="radio" name="r" value="2"> 2
							<input type="radio" name="r" value="3"> 3
							<input type="radio" name="r" value="4"> 4
							<input type="radio" name="r" value="5"> 5</p>
						</p>
					</div>
					<div class="inputX">
						<p class="heading"><b>Введите значение X:</b>
							<p><input id="text_x" type="text" size="15" name="x" placeholder="от -3 до 5" onblur="verifyX(this)" oninput="verifyX(this)"></p>
							<p id="message" style="visibility: hidden">.</p>
						</p>
					</div>
					<div class="chooseY">
						<p class="heading"><b>Выберите значение Y:</b>
								<table>
									<tr>
										<td><input type="checkbox" id="y1" name="y[]" value="-4"> -4</td>
										<td><input type="checkbox" id="y2" name="y[]" value="-3"> -3</td>
										<td><input type="checkbox" id="y3" name="y[]" value="-2"> -2</td>
									</tr>
									<tr>
										<td><input type="checkbox" id="y4" name="y[]" value="-1"> -1</td>
										<td><input type="checkbox" id="y5" name="y[]" value="0"> 0</td>
										<td><input type="checkbox" id="y6" name="y[]" value="1"> 1</td>
									</tr>
									<tr>
										<td><input type="checkbox" id="y7" name="y[]" value="2"> 2</td>
										<td><input type="checkbox" id="y8" name="y[]" value="3"> 3</td>
										<td><input type="checkbox" id="y9" name="y[]" value="4"> 4</td>
									</tr>
								</table>
						</p>
					</div>
					<div class="buttons">
						<table>
							<tr>
								<td>
									<input type="button" id="button" value=" Проверить " OnClick="check()">
								</td>
								<td>
									<input type="submit" id="submit"  OnClick="onSubmit()" value=" Результат " disabled>
								</td>
							</tr>
						</table>
					</div>
					<p id="error"></p>
				</form>
				<img src="images/image.png">
			</div>
			<div class="bottomSidebar">
				<div id="frame" class="container">
					<iframe name = "result"></iframe>
				</div>
			</div>
		</div>
		<div class="footer">Copyright © <a href="https://github.com/Lumenebris/web_lab1">Lumenebris</a>, 2019</div>
    </body>
</html>
