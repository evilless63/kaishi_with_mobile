window.moffConfig = {
	// Website CSS breakpoints.
	// Default values from Twitter Bootstrap.
	// No need to set xs, because of Mobile first approach.
	breakpoints: {
		sm: 640,
		md: 992,
		lg: 1200
	},
	loadOnHover: true,
	cacheLiveTime: 2000
};

$(document).ready(function(){
	$( ".themeSetsBlockImageCover" ).hover(
	  function() {
	    $( this ).children("span").css( "display", "block" );
	  }, function() {
	    $( this ).children("span").css( "display", "none" );
	  }
	);

	$( "#login" ).click(
		function(){
			$( ".loginWrapper" ).css( "display", "block" );	
		});
	
	$(".closeModalLogin").click(
		function(){
			$(".loginWrapper").css("display", "none");
		});	
	
	$( ".closeModalRegistration" ).click(
		function(){
			$( ".registrationWrapper" ).css( "display", "none" );
		});
	
	$( "#registration" ).click(
		function(){
			$( ".registrationWrapper" ).css( "display", "block" );	
		});

	$( ".registrationLink").click(
		function(){
			$(".loginWrapper").css("display", "none");
			$( ".registrationWrapper" ).css( "display", "block" );
		});

//Открываем профайл товара	

	$( ".sushiopenProfail, .sushiBlockImage" ).click(
		function(){
			var productId = $(this).attr('data-id');
			$.ajax({
			    url: "/product/" + productId,
			    type: "get",
			    data: {},
			    success: function(response){
			    	var data = JSON.parse(response);
			    	if(data.product_type == 'roll') {
			    		$('.tabs__contentBuyBlock').html(' <img src="/template/images/icons/mainMenu__rolls.svg" alt="">'+
                        '<span>*</span>'+
                        '<span>8</span>'+
                        '<span>=</span>'+
                        '<span class="productPrice">'+data.price+'<span class="min"> р</span></span>');
			    	} else {
			    		$('.tabs__contentBuyBlock').html('<span class="productPrice">'+data.price+'<span class="min"> р</span></span>');
			    	}
			        $('.sushiProfailArea').children('h3').html(data.name);
			        $('.productDescription').html(data.description);
			        $(".productModalImage").attr('src', '/upload/images/products/' + data.id + '.jpg');
			        $('.sushiBlockGetBusketProfail').attr('data-id', data.id);
			    },
			    // dataType: "json"
			});

			$( ".sushiProfailWrapper" ).css( "display", "block" );	
		});

//Открываем профайл товара	

		$( ".rowProductPaymentTocart" ).click(
		function(){
			$( ".sushiProfailWrapper" ).css( "display", "block" );	
		});
		
	$( ".closeModal" ).click(
		function(){
			$( ".sushiProfailWrapper" ).css( "display", "none" );
		});	
	
	$( ".sushiBlockToCatalog" ).click(
		function(){
			$( ".sushiProfailWrapper" ).css( "display", "none" );
		});		
	
	// $(".add-to-cart").click(
	// 	function(){
	// 		alert("Товар добавлен в корзину !");
	// 		$( ".sushiProfailWrapper" ).css( "display", "none" );
	// 	});	

	// $(".addCommentButton").click(
	// 	function(){
	// 		if($(".addCommentField").hasClass("hidden")){
	// 			$(this).removeClass("hidden").addClass("block");
	// 		} else {
	// 			$(this).removeClass("block").addClass("hidden");
	// 		}
	// 	});

	$(".addCommentButton").click(function(){
		$(".addCommentField").css("display", "block");
	});	


	$('.cartPaymentMethodsBlock').click(function(){

		$('.cartPaymentMethodsBlock').removeClass('actionBuySposob');
		$(this).addClass('actionBuySposob');

	});


	//cart page input value

	// $(".cartProductsBlockCountMinus").click(function(){
	// 	var inputValue = $(this).parent("cartProductsBlockCount").find("cartProductsBlockInputcount").val();
	// 	if(inputValue > "1") {
	// 		inputValue = inputValue --;
	// 	} else {
	// 		alert ("Выбрано минимальное количество товара !");
	// 	}
	// })


$('.ContentDescPromoBlockTocart').children('span').click(function(){

	var userName = $('.registrationFormName').val();
	var userSurname = $('.registrationFormSurname').val();
	var userAdress = $('.registrationFormAdress').val();
	var userPhone = $('.registrationFormPhone').val();
	var userComment = $('.addCommentField').val();
	var userAdressDop = $('#registrationFormTextarea').val();
	var userPayMethod = $('.actionBuySposob').html();
	var orderSumm = $('.orderSumm').html();

	if (userName !=="" && userSurname !== "" && userAdress !=="" && userPhone !== "" && userPayMethod !== "" ) {

		$.post(
		  "/cart/Addproducts",
		  {
		  	goOrder: 1,
		    userName: userName,
		    userSurname: userSurname,
		    userAdress: userAdress,
		    userPhone: userPhone,
		    userComment: userComment,
		    userAdressDop: userAdressDop,
		    userPayMethod: userPayMethod,
		    orderSumm: orderSumm
		  },
		  onAjaxSuccess
		);

	} else {

		alert("Заполните поля !")

	}

	 
	function onAjaxSuccess(data)
	{
	  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
	  alert("Заказ успешно создан, вам на телефон отправлен номер заказа и контрольная информация");
	  // Возвращаем пользователя в корзину
      location.reload();
	}

	

});

//Повторить заказ из кабинета пользователя
$('.zakazRowScheduleDesc').click(function(){
	var id = [];
	var i = 0;

	$(this).parent('.zakazRowSpoilerDesc').siblings('.zakazRowSpoilerWrap').each(function(){
		id.push($(this).children('.add-to-cart').attr('data-id'));
	});

	for(i; i < id.length; i++) {
		$.post("/cart/addAjax/"+id[i], {}, function (data) {
	        $("#cart-count").html(data);
	    });
	}
	
	alert("Товары успешно добавлены в корзину, вы будете перенаправлены в оформление заказа.");
	window.location.href = "/cart";
});

//Заказ тематического набора
$('.ContentDescPromoBlockTocartThematic').click(function(){
	var id = [];
	var i = 0;

	$('.ContentDescPromoBlock').each(function(){
		id.push($(this).attr('data-id'));
	});

	for(i; i < id.length; i++) {
		$.post("/cart/addAjax/"+id[i], {}, function (data) {
	        $("#cart-count").html(data);
	    });
	}
	
	alert("Тематический набор успешно добавлен в корзину, вы будете перенаправлены в оформление заказа.");
	window.location.href = "/cart";
});

//Оставить отзыв из личного кабинета

$('.zakazRowSchedule').click(function(){

	$('.feedbackLCcontent').css('display', 'flex');
	var heightR = $(document).height();// высота экрана
	var widthR = $(window).width();// ширина экрана

	$('.feedbackLCwrapper').css({'display':'block','width':widthR,'height':heightR});

	$('.feedbackLCcontent').css({
		position:'absolute',
		left: ($(document).width() - $('.feedbackLCcontent').outerWidth())/2,
		top: ($(document).height() - $('.feedbackLCcontent').outerHeight())/2
	}); 

	$('.feedbackLCsend').click(function(){
		var name = $('.feedbackLCname').text();
		var image = $('.feedbackLCimage').attr('src');
		var text = $('.feedbackLCtext').val();
		var mark = $('.feedbackLCmark').val();

		if (text !=="" && mark !== "" ) {

			$.post(
			  "/cabinet/addfeedback",
			  {
			  	goFeedback: 1,
			    name: name,
			    image: image,
			    text: text,
			    mark: mark,
			  },
			  function onAjaxSuccess(data)
			{
			  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
			  alert("Ваш отзыв успешно отправлен");
			  // Возвращаем пользователя в корзину
		      // location.reload();
			}
			);

		} else {

			alert("Заполните поля !");

		}
	});

});

$(document).mouseup(function(e){ // событие клика по веб-документу
	var div = $(".feedbackLCcontent"); // тут указываем ID элемента
	if (!div.is(e.target) // если клик был не по нашему блоку
	    && div.has(e.target).length === 0) { // и не по его дочерним элементам
		div.hide(); // скрываем его
		$('.feedbackLCwrapper').css('display', 'none');
	}
});


$('#contenInput').click(function(){

	var cartPaymentBlockCartnumber1 = $('#cartPaymentBlockCartnumber1').val();
	var cartPaymentBlockCartnumber2 = $('#cartPaymentBlockCartnumber2').val();
	var cartPaymentBlockCartnumber3 = $('#cartPaymentBlockCartnumber3').val();
	var cartPaymentBlockCartnumber4 = $('#cartPaymentBlockCartnumber4').val();
	var cartPaymentBlockCartnumber5 = $('#cartPaymentBlockCartnumber5').val();
	var cartPaymentBlockCartnumber6 = $('#cartPaymentBlockCartnumber6').val();

	$.post(
	  "/cart/Getcashcard",
	  {
	  	getCashCard: 1,
	    cartPaymentBlockCartnumber1: cartPaymentBlockCartnumber1,
	    cartPaymentBlockCartnumber2: cartPaymentBlockCartnumber2,
	    cartPaymentBlockCartnumber3: cartPaymentBlockCartnumber3,
	    cartPaymentBlockCartnumber4: cartPaymentBlockCartnumber4,
	    cartPaymentBlockCartnumber5: cartPaymentBlockCartnumber5,
	    cartPaymentBlockCartnumber6: cartPaymentBlockCartnumber6
	  },
	  function (data){
	  	alert(data);
	  }
	);

});
    
// Обработка ввода адреса в кабинете пользователя

$('.adressAdd').click(function(){
	
});

//Дополнительные товары в виде карусели на страниы корзины 
$('.aditionallyBlocks').slick({
  arrows: true,
  // infinite: true,
  slidesToShow: 5,
  slidesToScroll: 1
});    

//Обработка ввода номера скидочной карточки

// $( "#cartPaymentBlockCartnumber1" ).change(function(){
//   var cartPaymentBlockCartnumber1 = $('#cartPaymentBlockCartnumber1').val();
// });

// $( "#cartPaymentBlockCartnumber2" ).change(function(){
//   var cartPaymentBlockCartnumber2 = $('#cartPaymentBlockCartnumber2').val();
// });

// $( "#cartPaymentBlockCartnumber3" ).change(function(){
//   var cartPaymentBlockCartnumber3 = $('#cartPaymentBlockCartnumber3').val();
// });

// $( "#cartPaymentBlockCartnumber4" ).change(function(){
//   var cartPaymentBlockCartnumber4 = $('#cartPaymentBlockCartnumber4').val();
// });

// $( "#cartPaymentBlockCartnumber5" ).change(function(){
//   var cartPaymentBlockCartnumber5 = $('#cartPaymentBlockCartnumber5').val();
// });

// $( "#cartPaymentBlockCartnumber6" ).change(function(){
//   var cartPaymentBlockCartnumber6 = $('#cartPaymentBlockCartnumber6').val();



// 		$.post(
// 		  "/cart/Getcashcard",
// 		  {
// 		  	getCashCard: 1,
// 		    cartPaymentBlockCartnumber1: cartPaymentBlockCartnumber1,
// 		    cartPaymentBlockCartnumber2: cartPaymentBlockCartnumber2,
// 		    cartPaymentBlockCartnumber3: cartPaymentBlockCartnumber3,
// 		    cartPaymentBlockCartnumber4: cartPaymentBlockCartnumber4,
// 		    cartPaymentBlockCartnumber5: cartPaymentBlockCartnumber5,
// 		    cartPaymentBlockCartnumber6: cartPaymentBlockCartnumber6
// 		  },
// 		  function (data){
// 		  	alert("ALL OK");
// 		  }
// 		);

		
// });


});

(function($) {
$(function() {

  $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
    $(this)
      .addClass('active').siblings().removeClass('active')
      .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
  });

});
})(jQuery);


//MOBILE


$(document).ready(function(){
	$( ".formActionCartNext").click(
		function(){
			$(".chooseProucts").css("display", "none");
			$(".topAlert").css("display", "none");
			$(".choosePayment").css( "display", "block" );
		});

	$( ".formActionCartPrev").click(
		function(){
			$(".chooseProucts").css("display", "block");
			$(".topAlert").css("display", "flex");
			$(".choosePayment").css( "display", "none" );
		});
});	







