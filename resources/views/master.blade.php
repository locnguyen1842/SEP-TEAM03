<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel </title>
	<base href="{{asset('')}}">
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
	<link rel="stylesheet" href="source/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/cart.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
</head>
<body>

	@include('header')
	<div class="rev-slider">
		@yield('content')
	</div>
	@include('footer')



	<!-- include js files -->
	<script src="source/assets/dest/js/jquery.js"></script>
	<script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="source/assets/dest/vendors/animo/Animo.js"></script>
	<script src="source/assets/dest/vendors/dug/dug.js"></script>
	<script src="source/assets/dest/js/scripts.min.js"></script>
	
	<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="source/assets/dest/js/waypoints.min.js"></script>

	<script src="source/assets/dest/js/wow.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	{{-- custom js --}}

	<script type="text/javascript">
		$('#tinh_tp').on('change', function(e){
			console.log(e);
			var parent_code = e.target.value;
			$.get('/SEP-TEAM03/public/json-quan?parent_code=' + parent_code,function(data) {
				console.log(data);
				$('#quan_huyen').empty();
				$('#quan_huyen').append('<option value="0" disable="true" selected="true">--Chọn Quận/Huyện--</option>');

				$('#xa_phuong').empty();
				$('#xa_phuong').append('<option value="0" disable="true" selected="true">--Vui lòng chọn Quận/Huyện trước--</option>');



				$.each(data, function(index, quan_huyen){
					$('#quan_huyen').append('<option value="'+ quan_huyen.code +'">'+ quan_huyen.name +'</option>');
				})
			});
		});

		$('#quan_huyen').on('change', function(e){
			console.log(e);
			var parent_code = e.target.value;
			$.get('/SEP-TEAM03/public/json-xa?parent_code=' + parent_code,function(data) {
				console.log(data);
				$('#xa_phuong').empty();
				$('#xa_phuong').append('<option value="0" disable="true" selected="true">--Chọn Xã/Phường--</option>');

				$.each(data, function(index, xa_phuong){
					$('#xa_phuong').append('<option value="'+ xa_phuong.code +'">'+ xa_phuong.name +'</option>');
				})
			});
		});

	</script>
	<script src="source/assets/dest/js/custom2.js"></script>
</script>

<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
				$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
			)
	})
</script>
<script type="text/javascript">
	$(function(){
		$('.addNewAddress').on('click', function(e){
			e.preventDefault();
			$('#formAddNewAddress').show();
		});
		$('#huyboaddress').on('click', function(e){
			e.preventDefault();
			$('#formAddNewAddress').hide();
		});
		
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		<?php for($i=1;$i<=Cart::instance('default')->count();$i++){
		?>
		$('#quantitycart<?php echo $i; ?>').on('change keyup',function(){
			var quantity = $('#quantitycart<?php echo $i; ?>').val();
			var rowId = $('#rowId<?php echo $i; ?>').val();
			var proId = $('#proId<?php echo $i; ?>').val();
			if(quantity <=0) {
				alert('Vui Lòng Chọn Số Lượng')
			}
			else{
				$.ajax({
					type:'get',
					dataType:'html',
					url:'<?php echo url('/cart-update'); ?>/'+rowId,
					data:"qty="+quantity + "& rowId="+rowId+"& proId="+proId,
					success: function(respone){
						location.reload();
					}

				});
			}


		});
		<?php
			}
		?>
	});
</script>
</body>
</html>
