function LogIn(){ // формирует панель ввода логина и пароля
	var string = "<form action=\"/news\" method=\"post\" class=\"aside-form\">";
	string+= "<input type=\"text\" placeholder=\"Логин\" name=\"login\" class=\"aside-buttons__input-text\" required=\"required\">";
	string+= "<input type=\"password\" placeholder=\"Пароль\" name=\"password\" class=\"aside-buttons__input-text\" required=\"required\">";
	string+= "<div class=\"clearfix\">";
	string+= "<input type=\"submit\" value=\"Войти\" class=\"reg-buttons__input-button\">";
	string+= "<button class=\"reg-buttons__input-button\" onclick=\"back_login()\">Назад</button>";
	string+= "</div>";
	string+= "</form>";
	document.getElementById('reg-buttons').innerHTML=string;
}

function back_login(){ // назад из панели логина
	var string = "<button class=\"aside-button__reg\" onclick=\"LogIn()\">Войти</button>";
	string+= "<a href=\"/registration\" class=\"aside-button__reg\">Регистрация</a>";
	document.getElementById('reg-buttons').innerHTML=string;
}

function more_news(num){ // выводит больше новостей
	$.ajax({
		url: "/news/MoreNews",
		type: "POST",
		data: ({num: num}),
		success: more_news_success
	});
}
var id_block = 0; // для блока вывода дополнительных новостей
function more_news_success(data){
	var id = 'block_'+id_block;
	document.getElementById(id).innerHTML = data;
	id_block++;
}

$("#add_bars").click(function(){ // для боковой панели
	$(".aside").animate({width:"220px"},500);
})
$("#aside_back").click(function(){
	$(".aside").animate({width:"0px"},500);
})

var test_height = false;
$(".header_options__icon_cog").click(function(){ // для настроек
	if (test_height == false){
		$(".header_options__menu").css("max-height","300px");
		$(".header_options__icon_cog").css("transform","rotate(90deg)");
		test_height = true;
	}
	else{
		$(".header_options__menu").css("max-height","0px");
		$(".header_options__icon_cog").css("transform","rotate(0deg)");
		test_height = false;
	}
});