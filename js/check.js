//сообщение для x
function message(msg) {
   var node = document.getElementById('message');
    node.innerText = msg;
    node.style.visibility = 'visible';
}

//проверка x
function verifyX(x) {
	const xMax = 5;
	const xMin = -3;
    let pattern = new RegExp(/^(-?0$|-?[1-9]*([,.]\d*$)?|-?0[,.]\d*$)$/);
    let xValue = parseFloat(x.value.replace(/,/, '.'));
    let elem = document.getElementById('text_x');
	let flag = 0;
    if (x.value != '' && x.value != '-') {
		if (isNaN(xValue)) {
			x.focus();
            elem.style.backgroundColor = '#bb99ff';
			message('х должен быть числом');
			x.value = '';
            return false;
		} else if (!pattern.test(x.value)) {
            x.focus();
            elem.style.backgroundColor = '#bb99ff';
			message('х должен быть числом');
			x.value = '';
            return false;
        } else if (xValue < xMin || xValue > xMax) {
			x.focus();
            elem.style.backgroundColor = '#bb99ff';
			message('x вне диапазона');
			x.value = '';
            return false;
		} else if (x.value.length > 5) {
			x.focus();
            elem.style.backgroundColor = '#bb99ff';
			message('длина x не должна превышать 5');
			x.value = '';
            return false;
		}
        elem.style.backgroundColor = '#FFF';
		document.getElementById('message').style.visibility = 'hidden';
        return true;
    }
    elem.style.backgroundColor = '#FFF';
	document.getElementById('message').style.visibility = 'hidden';
    return true;
}

//повторная проверка x
function checkX() {
    let xInput = document.getElementById('text_x');
	let pat1 = new RegExp(/^(-?[0-9]*[,.]0*$)$/);
	let pat2 = new RegExp(/^(-?0[,.]0*$)$/);
	if (pat1.test(xInput.value)) {
		if (pat2.test(xInput.value)) {
			xInput.value = '0';
		} else xInput.value = xInput.value.replace(/[,.]0*/, '');
	}
}

//проверка x и y
function check() {
	let error = document.getElementById('error');
    let xInput = document.getElementById('text_x');
	let yArray = Array.from(document.querySelectorAll('[id="y1"], [id="y2"], [id="y3"], [id="y4"], [id="y5"], [id="y6"], [id="y7"], [id="y8"], [id="y9"]'));
	let flag_y = 0;
	let flag_x = 0;
	error.innerHTML = '';
	
	//проверка x
	if (xInput.value != '') {
		flag_x = 1;
	} 
	
	//если x не введен
	if (!flag_x) {
		let err_x = document.createElement('div');
		err_x.innerHTML = 'Не введено значение x';
		error.append(err_x);
	}
	
	//проверка y
	for (y of yArray) {
		if (y.checked) {
			flag_y = 1;
		}
	}
	
	//если y не выбран
	if (!flag_y) {
		let err_y = document.createElement('div');
		err_y.innerHTML = 'Не выбрано значение y';
		error.append(err_y);
	}
	
	//если x и y правильные
	if (flag_x && flag_y) {
		document.getElementById("flag").value = 0;
	}
}
