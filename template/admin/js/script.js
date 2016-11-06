$(document).ready(function(){
//Запуск функций уменьшения увеличения количества выбранного товара, запись данных в память
//Запуск функции удаления продукта, запись в память
productCountPlus();

productCountMinus();

delCurrentProduct();


//Запуск функций уменьшения увеличения количества выбранного товара, запись данных в память
//Запуск функции удаления продукта, запись в память
//Конец


//Обновление состояния заказа и запись данных в базу
$('#person_card_submit').click(function(){
	if (confirm('Вы уверены в том, что хотите обновить заказ ? Изменения будут внесены в базу данных')) {

	    var productsObj = new Object();
		$('.productContaner').each(function(i, elem){
			productsObj[$(this).children('.get_product_id').val()] = Number($(this).children('.cur_application_count_body').html());
		});

		var products = JSON.stringify(productsObj);
		var orderId = $('.order_id').val();
		var orderStatus = $('.get_active_status').attr('status');
		if(orderStatus == undefined){
			alert('Укажите статус заказа !');
			return false;
		}
		var orderSumm = $('.wholeSumm').html();
		var orderPhone = $('.person_card_phone').val();
		var orderAdress = $('.person_card_adress').val();
		var orderName = $('.person_card_name').val();
		var orderComment = $('.comments_textarea').val();
		var orderCommentAdmin = '';

		$.post(
			"/admin/order/update/" + orderId,
			{
			  	goUpdate: 1,
			    products: products,
			    orderStatus: orderStatus,
			    orderSumm: orderSumm,
			    orderPhone: orderPhone,
			    orderAdress: orderAdress,
			    orderName: orderName,
			    orderComment: orderComment,
			    orderCommentAdmin: orderCommentAdmin,
			},
			  function(data){
			  	alert(data);
			  	document.location.href='/admin/order/view/' + orderId;
			}
		);

	} else {
	    alert("Обновление заказа отменено");
	}


});

$('.button_status').click(function(){
	if($(this).hasClass('get_active_status')){
		$('.button_status').removeClass('get_active_status');
		$('.button_status').each(function(i, elem){
			$(this).removeClass('get_active_status');
		});
	} else {
		$(this).addClass('get_active_status');
		$('.button_status').not(this).removeClass('get_active_status');
	}
});
//Обновление состояния заказа и запись данных в базу
//Конец


//УДАЛЕНИЕ ЗАКАЗА (СТАТУС 6)
$('.app_button_delete').click(function(){

	var heightR = $(document).height();// высота экрана
	var widthR = $(window).width();// ширина экрана

	$('.admin_delete_background').css({'display':'block','width':widthR,'height':heightR}); 
	$('.main_board').append('<div class="admin_delete_comment_wrapper">'
		+ '<h1 class="main_board_h1"><span>Объясните причину удаления</span></h1>'
		+ '<textarea class="admin_delete_comment"></textarea>' 
		+ '<div class="admin_delete_button_wrapper">'
		+ '<div class="app_button_delete_order ">Сохранить</div>'
		+ '<div class="app_button_delete_order_cancel">Отмена</div>'
		+ '</div>'
		+ '<div>');
	$('.app_button_delete_order').click(function(){

		if (confirm('Вы уверены в том, что хотите удалить заказ ? Изменения будут внесены в базу данных, восстановление заказа не возможно')) {

		    var productsObj = new Object();
			$('.productContaner').each(function(i, elem){
				productsObj[$(this).children('.get_product_id').val()] = Number($(this).children('.cur_application_count_body').html());
			});

			var products = JSON.stringify(productsObj);
			var orderId = $('.order_id').val();
			var orderSumm = $('.wholeSumm').html();
			var orderPhone = $('.person_card_phone').val();
			var orderAdress = $('.person_card_adress').val();
			var orderName = $('.person_card_name').val();
			var orderComment = $('.comments_textarea').val();
			if( $('.admin_delete_comment').val() == '') {
				alert('Заполните комментарий удаления заказа !');
				$('.admin_delete_comment_wrapper').remove();
				$('.admin_delete_background').css('display', 'none');
				return false;
			} else {
				var orderCommentAdmin = $('.admin_delete_comment').val();
			}
			
			
			$.post(
				"/admin/order/update/" + orderId,
				{
				  	goUpdate: 1,
				    products: products,
				    orderStatus: 6,
				    orderSumm: orderSumm,
				    orderPhone: orderPhone,
				    orderAdress: orderAdress,
				    orderName: orderName,
				    orderComment: orderComment,
				    orderCommentAdmin: orderCommentAdmin,
				},
				  function(data){
				  	alert(data);
				  	document.location.href='/admin/order/view/' + orderId;
				}
			);

		} else {
		    alert("Удаление заказа отменено");
		    $('.admin_delete_background').css('display', 'none');
		}
	});

	$('.app_button_delete_order_cancel').click(function(){
		$('.admin_delete_comment_wrapper').remove();
		$('.admin_delete_background').css('display', 'none');
	});
});	


//УДАЛЕНИЕ ЗАКАЗА КОНЕЦ



//ДОБАВЛЕНИЕ ПУНКТОВ В ЗАКАЗ
$('.cur_application_body_add_product').click(function(){

	$('.addProductWindow').css('display', 'block');
	var heightR = $(document).height();// высота экрана
	var widthR = $(window).width();// ширина экрана

	$('.addProductWrapper').css({'display':'block','width':widthR,'height':heightR}); 

});

$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".addProductWindow"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			div.hide(); // скрываем его
			$('.addProductWrapper').css('display', 'none');
		}
	});

$('.catalogType').click(function(event){
	event.preventDefault();
	event.stopImmediatePropagation();
	$('.catalogType').removeClass('dataResultContainer');
	$('.results').empty();
	$('.catalogType').children().removeClass('results');
	$(this).addClass('dataResultContainer');
	$(this).children().addClass('results');
	var categoryId = $(this).attr('hasid');

	$.ajax({
	  type: 'POST',
	  url: "/adminOrder/getcategory/" + categoryId,
	  data: { categoryId: categoryId },
	  success: function(data){
	  	// var string = JSON.parse(data);
	  	var jsonString  = JSON.parse ( data )
	  	var resultThead = "<tr><td>ID товара</td><td>Наименование товара</td><td>Стоимость за 1 шт</td></tr>";
	  	$(resultThead).appendTo('.results');
	  	for (var i = 0 ; i <= jsonString.length-1 ; i++) {
	  		var result = "<tr class='addingProductWrapper'><td class='addingProductId'>" + jsonString[i].id + "</td><td class='addingProductName'>" + jsonString[i].name + "</td><td class='addingProductPrice'>" + jsonString[i].price + "</td></tr>"; 
	  		$(result).appendTo('.results');
	  	}

	  	$('.addingProductWrapper').click(function(event){
		event.preventDefault();
		event.stopPropagation();
		var newAddedProduct = '<tr class="productContaner">' +
		    '<input type="hidden" class="get_product_id" value="'+ $(this).children('.addingProductId').html() +'" />' +
		    '<td class="cur_application_number_body"></td>' +
		    '<td class="cur_application_product_body">'+ $(this).children('.addingProductName').html() +'</td>' +
		    '<td class="cur_application_count_body">1</td>' +
		    '<td class="cur_application_change_count_body">' +
		        '<div class="my my_q countPlus"></div>' +
		        '<div class="my my_r countMinus"></div>' +
		    '</td>' +
		    '<td class="cur_application_delete_count_body">' +
		        '<div class="my my_s deleteCurrentPosition"></div>' +
		    '</td>' +
		    '<td class="cur_application_cost_body">'+ $(this).children('.addingProductPrice').html() +'</td>' +
		    '<td class="cur_application_summ_body">'+ $(this).children('.addingProductPrice').html() +'</td>' +
		'</tr>';

		$(newAddedProduct).appendTo('.cur_application_body');

		var prices = new Array();
		$('.cur_application_summ_body').each(function(i, elem){
			prices.push($(this).html());
		});
		var wholeSumm=0;
		for(var i=0;i<prices.length;i++){
		    wholeSumm = wholeSumm + Number(prices[i]);

		}
		$('.wholeSumm').text(wholeSumm);

		productCountPlus();

		productCountMinus();

		delCurrentProduct();
		});
	  }
	});

	


});
//ДОБАВЛЕНИЕ ПУНКТОВ В ЗАКАЗ КОНЕЦ



//Программирование обработчиков при открытии страницы
	$('#trigg').click(function(e){
	    e.preventDefault();

	    if(!$.trim( $('.getAdminCommentDelete').html() ).length){
			$('.getAdminCommentDelete').css('display', 'none');
		}

	    //Расчет общей стоимости конкретного продукта, исходя из количества в штуках и его стоимости
	    $('.productContaner').each(function(i, elem){
			var count = Number($(this).children('.cur_application_count_body').html());
			var price = Number($(this).children('.cur_application_cost_body').html());

			var summ = count*price;
			$(this).children('.cur_application_summ_body').text(summ);
		});
		//Расчет общей стоимости конкретного продукта, исходя из количества в штуках и его стоимости 

		//ПРОВЕРКА СТАТУСА И ОТМЕТКА НА СООТВЕТСТВУЮЩЕЙ КНОПКЕ СТАТУСА КРАСНЫМ	
		var tookenOrderStatus = $('.user_orderstatus').val();
		$('.button_status').each(function(i, elem){
			if($(this).attr('status') == tookenOrderStatus) {
			$(this).css('background-color', 'red');
			$(this).addClass('hasStatus');
		}
		});
		//ПРОВЕРКА СТАТУСА И ОТМЕТКА НА СООТВЕТСТВУЮЩЕЙ КНОПКЕ СТАТУСА КРАСНЫМ	END



	});
//Программирование обработчиков при открытии страницы КОНЕЦ	

//Запус запрограммированных обработчиков при открытии страницы
	$(window).load(function(){
	    $('#trigg').trigger('click');
	});
//Запус запрограммированных обработчиков при открытии страницы КОНЕЦ



//Изменение количества товаров и удаление в случае уменьшения количества выбранной
// позиции до 0 + изменение общей суммы позиций
function productCountPlus(){
	$('.countPlus').click(function(){

		

		var count = Number($(this).parents().siblings('.cur_application_count_body').html());
		var newCount = count + 1;
		newCountString = String(newCount);
		$(this).parents().siblings('.cur_application_count_body').text(newCountString);

		var	count = newCount; 
		var price = Number($(this).parents().siblings('.cur_application_cost_body').html());	
		var newPositionSumm = count*price;
		$(this).parents().siblings('.cur_application_summ_body').text(newPositionSumm);

		var prices = new Array();
		$('.cur_application_summ_body').each(function(i, elem){
			prices.push($(this).html());
		});
		var wholeSumm=0;
		for(var i=0;i<prices.length;i++){
		    wholeSumm = wholeSumm + Number(prices[i]);

		}
		$('.wholeSumm').text(wholeSumm);

	});
};

function productCountMinus(){
	$('.countMinus').click(function(){
	
		var oldCount =$(this).parents().siblings('.cur_application_count_body').html();

		if(oldCount == "0"){
			
			if (confirm('Вы уверены, что ходите удалить данную позицию из заказа ?')) {
		    
				$(this).closest('tr').remove();

			} else {
				return false;
			}

		} else {

			var count = Number($(this).parents().siblings('.cur_application_count_body').html());
			var newCount = count - 1;
			if (newCount == 0) {

				if (confirm('Вы уверены, что ходите удалить данную позицию из заказа ?')) {
		    
					$(this).closest('tr').remove();

					var prices = new Array();
					$('.cur_application_summ_body').each(function(i, elem){
						prices.push($(this).html());
					});
					var wholeSumm=0;
					for(var i=0;i<prices.length;i++){
					    wholeSumm = wholeSumm + Number(prices[i]);

					}
					$('.wholeSumm').text(wholeSumm);

				} else {
					return false;
				}

			} else {
				newCountString = String(newCount);
				$(this).parents().siblings('.cur_application_count_body').text(newCountString);
				var	count = newCount; 
				var price = Number($(this).parents().siblings('.cur_application_cost_body').html());	
				var newPositionSumm = count*price;
				$(this).parents().siblings('.cur_application_summ_body').text(newPositionSumm);

				var prices = new Array();
				$('.cur_application_summ_body').each(function(i, elem){
					prices.push($(this).html());
				});
				var wholeSumm=0;
				for(var i=0;i<prices.length;i++){
				    wholeSumm = wholeSumm + Number(prices[i]);

				}
				$('.wholeSumm').text(wholeSumm);
			}	
			
		}

	});
}

function delCurrentProduct(){
	$('.deleteCurrentPosition').click(function(){

		if (confirm('Вы уверены, что ходите удалить данную позицию из заказа ?')) {
		    
			$(this).closest('tr').remove();

			var prices = new Array();
			$('.cur_application_summ_body').each(function(i, elem){
				prices.push($(this).html());
			});
			var wholeSumm=0;
			for(var i=0;i<prices.length;i++){
			    wholeSumm = wholeSumm + Number(prices[i]);

			}
			$('.wholeSumm').text(wholeSumm);

		} else {
			return false;
		}

	});
}
//Изменение количества товаров и удаление в случае уменьшения количества выбранной позиции до 0 END

//Переход в заказ через TR data=href
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
//Переход в заказ через TR data=href END


//Динамический поиск заказов по номеру чека
//Живой поиск
	$('.app_search').bind("change keyup input click", function() {
	    if(this.value.length >= 1){
	        $.ajax({
	            type: 'post',
	            url: "http://shop/ds/config/orderSearch.php", //Путь к обработчику
	            data: {'referal':this.value},
	            response: 'text',
	            success: function(data){
	                $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
	           }
	       })
	    }
	})
	    
	$(".search_result").hover(function(){
	    $(".app_search").blur(); //Убираем фокус с input
	})
	    
	//При выборе результата поиска, прячем список и заносим выбранный результат в input
	// $(".search_result").on("click", "li", function(){
	//     s_user = $(this).text();
	//     //$(".app_search").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
	//     $(".search_result").fadeOut();
	// })
//Динамический поиск заказов по номеру чека КОНЕЦ

//Другие функции
function accept_person_card(){
	if (confirm('Вы уверены ? Изменения будут внесены в базу данных')) {
	    // Save it!
	} else {
	    // Do nothing!
	}
}

function accept_manage_application(element){
	if (element.hasClass("__active")) {
		alert("Данные уже внесены, для редактирования внесенных ранее данных, пожалуйста, обратитесь к супер администратору !")	
	} else {
		if (confirm('Вы уверены ? Изменения будут внесены в базу данных')) {
	    element.addClass("__active")
	    // Save it!
		} else {
		    // Do nothing!
		}
	}
	
}
});