function edit_comment(id_news,id_comment){ // изменение комментария модератором
	var id = 'comment_'+id_comment;
	var comment = document.getElementById(id).innerHTML;
	var string = "<form action=\"javascript:void(null);\" method=\"post\" onsubmit=\"edit_comment_ajax("+id_comment+", "+id_news+")\" id=\"form_"+id_comment+"\">";
	string += "<textarea class=\"add_comment__textarea\" name=\"edit_comment_text\" id=\"textarea_comment_"+id_comment+"\">";
	string += comment;
	string += "</textarea>";
	//string += "<input type=\"button\" value=\"Сохранить\" class=\"news__comments_admin_button_save\" onclick=\"edit_comment_ajax("+id_comment+","+id_news+")\">";
	string += "<input type=\"hidden\" name=\"id_comment_edit\" value=\""+id_comment+"\">";
	string += "<input type=\"submit\" value=\"Сохранить\" class=\"news__comments_admin_button_save\"></form>";
	string += "<button class=\"news__comments_admin_button left\" onclick=\"back_edit_comment('"+comment+"',"+id_news+","+id_comment+")\">Отмена</button>";
	document.getElementById(id).innerHTML = string;
	id = 'comment_edit_button_'+id_comment;
	document.getElementById(id).innerHTML = '';
}

function back_edit_comment(comment,id_news,id_comment){ // откатывает редактирование комментов
	var id = 'comment_'+id_comment;
	document.getElementById(id).innerHTML = comment;
	id = 'comment_edit_button_'+id_comment;
	var string = "<button class=\"news__comments_admin_button\" onclick=\"edit_comment("+id_news+","+id_comment+")\">Редактировать</button>";
	document.getElementById(id).innerHTML = string;
}

function delete_news(id_news){ // если хочет удалить новость
	var string = "<div class=\"delete_massage_news\">Вы Уверены?</div>";
	string += "<div class=\"clearfix delete_news_buttons\">";
	string += "<form action=\"/editnews/delete\" method=\"POST\">";
	string += "<input type=\"hidden\" name=\"delete_news\" value=\""+id_news+"\">";
	string += "<input type=\"submit\" value=\"Да\" class=\"delete_news_button_yes\">";
	string += "</form>";
	string += "<button onclick=\"back_delete_button("+id_news+")\" class=\"delete_news_button_no\">Нет</button>";
	document.getElementById('delete_news_form').innerHTML = string;
}
function back_delete_button(id_news){  // откатывает если пользователь не уверен в удиалении новости 
	var string = "<button class=\"edit_news__button\" onclick=\"delete_news("+id_news+")\">Удалить</button>";
	document.getElementById('delete_news_form').innerHTML = string;
}

function more_comments(num,id_news){ // выводит больше комментов
	$.ajax({
		url: "/news/MoreComments/"+id_news,
		type: "POST",
		data: ({num: num, id_news: id_news}),
		success: more_comments_success
	});
}
var id_comments = 0; // для блока вывода дополнительных новостей
function more_comments_success(data){
	var id = 'comments_'+id_comments;
	document.getElementById(id).innerHTML = data;
	id_comments++;
}


function delete_comment(id){
	var id_box = '#comment_box_'+id;
	//alert(id_box);
	$(id_box).css("display","none");
	$.ajax({
		url: "/comments/delete/"+id,
		type: "POST",
		data: ({id_comment_delete: id}),
	});
}

function edit_comment_ajax(id_comment, id_news){
	var id_form ='#form_'+id_comment;
	var msg = $(id_form).serialize();
	$.ajax({
		url: "/comments/edit/"+id_news,
		type: "POST",
		data: msg,
		success: function(data){
			back_edit_comment(data, id_news, id_comment);
		}
	});
}

function addComment(id_news){
	var msg = $('#add_comment').serialize();
	$.ajax({
		url: "/comments/add/"+id_news,
		type: "POST",
		data: msg,
		success: function(data){
			var text = data + $('#new_comments').html();
			$('#new_comments').html(text);
		}
	});
}