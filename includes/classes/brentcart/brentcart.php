<?php
/*
echo '<script type="text/javascript" src="' . $template->get_template_dir('.js', DIR_WS_TEMPLATE, $current_page_base, 'jscript') . '/jquery-1.6.4.min.js"></script>';
*/
?>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
	
		var totalCartString = $('#cartSubTotal');
	
		//update cart quantity
		$(".cartQuantityUpdate input").click(function(e){	
				e.preventDefault();
				var data = $('form[name=cart_quantity]').serialize();
				$.ajax({
					type: "post",
					url: "index.php?main_page=shopping_cart&action=update_product",
					data: data,
					success: function(){
					//	$(this).parentsUntil("tbody").animate({ opacity: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
					}	
				});
				
				$(this).parent().nextAll('.cartTotalDisplay').wrapInner('<span class = "totalCartPrice"/>').animate({opacity: 0});
				
				
				$(this).parent().nextAll('.cartTotalDisplay')
				.load('index.php?main_page=shopping_cart .cartTotalDisplay', function(){
					$(this).wrapInner("<span/>").children().children().each(function(index){	
						if ((index + 1) == $(this).parent().parent().parent().index()) {
							$(this).siblings().remove();	
							}
					});
				
				}).animate({opacity : 1});	
				totalCartString.wrapInner('<div id = "cartText"/>');
				$('#cartText').fadeOut().load('index.php?main_page=shopping_cart #cartSubTotal').fadeIn();
						
		});//click
		
		//delete items from cart
		$(".cartRemoveItemDisplay a").click(function(e){
				e.preventDefault();
				var del_id = $(this).parent().find('input').attr('value');
				var info = "action=remove_product&product_id=" + del_id;			
				$.ajax({
					type: "get",
					url: "index.php",
					data: info ,
					success: function(){
						totalCartString.wrapInner('<div id = "cartText"/>');
						$('#cartText').fadeOut().load('index.php?main_page=shopping_cart #cartSubTotal').fadeIn();
						
					}
				});
			$(this).parentsUntil("tbody").animate({ opacity: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
				
		});
		
	});  //ready close
						
				
</script>