var test_login = false; // правильность ввода логина
var test_email = false;
var test_pasw1 = false;
var test_pasw2 = false;
$('#name_reg').focusout(function(){ // проверка логина
	var change_login = document.getElementById('name_reg').value;
	var login_const = /^([А-Яа-яA-Za-z0-9_ -]+\.)*[А-Яа-яA-Za-z0-9_ -]{4,20}$/;
	if (login_const.test(change_login) == true && change_login != "" && change_login != " "){
		$.ajax({ // запрос на совпадения в БД
			url: "/registration/Ajax_CheckNameForRegistration",
			type: "POST",
			data: ({login: change_login}),
			success: function(data){
				document.getElementById('name_reg_res').innerHTML = data;
			}
		});
		test_login = true;
		test_ready_reg();
	}
	else if (change_login == "") {
		document.getElementById('name_reg_res').innerHTML = "";
		test_login = false;
		test_ready_reg();
	}
	else{
		var err = "<div class=\"red reg_success\">Некоректный login</div>";
		document.getElementById('name_reg_res').innerHTML = err;
		test_login = false;
		test_ready_reg();
	}
});

$('#email_reg').focusout(function(){ // проверка emaila 
	var change_email = document.getElementById('email_reg').value;
	var email_const = /^([A-Za-z0-9_-]+\.)*[A-Za-z0-9_-]+@[A-Za-z0-9_-]+(\.[A-Za-z0-9_-]+)*\.[A-Za-z]{2,6}$/;
	if (email_const.test(change_email) == true && change_email != "" && change_email != " "){
		$.ajax({
			url: "/registration/Ajax_CheckEmailForRegistration",
			type: "POST",
			data: ({email: change_email}),
			success: function(data){
				document.getElementById('email_reg_res').innerHTML = data;
			}
		});
		test_email = true;
		test_ready_reg();
	}
	else if (change_email == ""){
		document.getElementById('email_reg_res').innerHTML = "";
		test_email = false;
		test_ready_reg();
	}
	else{
		var err = "<div class=\"red reg_success\">Некоректный email</div>";
		document.getElementById('email_reg_res').innerHTML = err;
		test_email = false;
		test_ready_reg();
	}
});

$('#pasw_reg').focusout(function(){ // проверка вводимого пароля
	var change_pasw1 = document.getElementById('pasw_reg').value;
	var pasw_const = /^([А-Яа-яA-Za-z0-9_-]+\.)*[А-Яа-яA-Za-z0-9_-]{4,20}$/;
	if (pasw_const.test(change_pasw1) == true && change_pasw1 != "" && change_pasw1 != " "){
		var err = "<div class=\"green reg_success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></div>";
		document.getElementById('pasw1_reg_res').innerHTML = err;
		test_pasw1 = true;
		test_ready_reg();
	}
	else if (change_pasw1 == ""){
		document.getElementById('pasw1_reg_res').innerHTML = "";
		test_pasw1 = false;
		test_ready_reg();
	} 
	else{
		var err ="<div class=\"red reg_success\">Некоректный пароль</div>";
		document.getElementById('pasw1_reg_res').innerHTML = err;
		test_pasw1 = false;
		test_ready_reg();
	}
});

$('#pasw2_reg').focusout(function(){ // проверка совместимости пароля
	var pasw1 = document.getElementById('pasw_reg').value;
	var pasw2 = document.getElementById('pasw2_reg').value;
	if (pasw1 != pasw2){
		var err = "<div class=\"red reg_success\">Пароли не совпадают</div>";
		document.getElementById('pasw2_reg_res').innerHTML = err;
		test_pasw2 = false;
		test_ready_reg();
	}
	else{
		var err = "<div class=\"green reg_success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></div>";
		document.getElementById('pasw2_reg_res').innerHTML = err;
		test_pasw2 = true;
		test_ready_reg();
	}
});

function test_ready_reg(){
	if (test_login == true && test_email == true && test_pasw1 == true && test_pasw2 == true){
		var string = "<input type=\"submit\" class=\"regist-button__reg green border-green\" value=\"Зарегистрироваться\">";
	}
	else{
		var string = "<input type=\"button\" class=\"regist-button__reg red border-red\" value=\"Зарегистрироваться\">";
	}
	document.getElementById('regist-button__registration').innerHTML = string;
}