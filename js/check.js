function check() {
	var error = document.getElementById("error");
	error.innerHTML = "";
	const xMax = 5;
	const xMin = -3;
	var x = "";
	var xInput = document.getElementById("text_x");
	var yArray = Array.from(document.querySelectorAll('[id="y1"], [id="y2"], [id="y3"], [id="y4"], [id="y5"], [id="y6"], [id="y7"], [id="y8"], [id="y9"]'));
	var flag_y = 1;
	var flag_x = 2;
	document.getElementById("submit").disabled = 1;
	//проверка y
	for (y of yArray) {
		if (y.checked) {
			flag_y = 0;
			//yCount++;
		}
	}
	//если y не выбран
	if (flag_y) {
		let err_y = document.createElement('div');
		err_y.innerHTML = 'Не выбрано значение y';
		error.append(err_y);
	}
	//проверка x
	var pattern = new RegExp(/^(0$|-?[1-9]\d*([,.]\d*[1-9]$)?|-?0[,.]\d*[1-9])$/);
	if (xInput.value) {
		if (xInput.value.length < 6) {
			for (i = 0; i < xInput.value.length; i++) {
				if (xInput.value[i] != ' ') {
					x += String(xInput.value[i].replace(',', '.'));
				} else {
					flag_x = 4;
					i = xInput.value.length;
				}
			}
			if (pattern.test(x)) flag_x = 0;
			else flag_x = 2;
			if (flag_x != 2 & flag_x != 4 ) {
				if ((x < xMin) || (x > xMax)) flag_x = 3;
			}
		} else flag_x = 5;
	} else flag_x = 1;
	//если x неправильный
	if (flag_x) {
		let err_x = document.createElement('div');
		if (flag_x == 1)
			err_x.innerHTML = "Не выбрано значение x";
		if (flag_x == 2)
			err_x.innerHTML = "Ошибка в значении x";
		if (flag_x == 3)
			err_x.innerHTML = "x вне диапазона";
		if (flag_x == 4)
			err_x.innerHTML = "х должен быть числом";
		if (flag_x == 5)
			err_x.innerHTML = "Длина x не должне превышать 5";
			error.append(err_x);
	}
	//если x и y правильные
	if (flag_x == 0 && flag_y == 0) {
		document.getElementById("submit").disabled = 0;
	}
}
