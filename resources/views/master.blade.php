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
	<!--customjs-->
	{{-- <script type="text/javascript">
      $('#tinh').on('change', function(e){
        console.log(e);
        var province_id = e.target.value;
        $.get('/quan?tinh_id=' + province_id,function(data) {
          console.log(data);
          $('#quan').empty();
          $('#quan').append('<option value="0" disable="true" selected="true">=== Select quan ===</option>');

        
          $('#xa').empty();
          $('#xa').append('<option value="0" disable="true" selected="true">=== Select xa ===</option>');

          $.each(data, function(index, quanObj){
            $('#quan').append('<option value="'+ quanObj.code +'">'+ quanObj.name +'</option>');
          })
        });
      });

      $('#districts').on('change', function(e){
        console.log(e);
        var districts_id = e.target.value;
        $.get('/xa?districts_id=' + districts_id,function(data) {
          console.log(data);
          $('#xa').empty();
          $('#xa').append('<option value="0" disable="true" selected="true">=== Select xa ===</option>');

          $.each(data, function(index, xaObj){
            $('#xa').append('<option value="'+ xaObj.code +'">'+ xaObj.name +'</option>');
          })
        });
      });


    </script> --}}
   <script>
	$(document).ready(function(){

		load_json_data('tinh');

		function load_json_data(code, parent_code)
		{
			var html_code = '';
			$.getJSON('https://api.myjson.com/bins/9emny', function(data){

				html_code += '<option value="">Select '+code+'</option>';
				$.each(data, function(key, value){
					if(id =='tinh'){
						html_code += '<option value="'+value.code+'">'+value.name+'</option>';	
					}
					else
					{
						if(value.parent_id == parent_id)
						{
							html_code += '<option value="'+value.id+'">'+value.name+'</option>';
						}
					}

				});
				$('#'+code).html(html_code);
			});

		}

		$(document).on('change', '#tinh', function(){
			var country_id = $(this).val();
			if(country_id != '')
			{
				load_json_data('quan', country_id);
			}
			else
			{
				$('#quan').html('<option value="">Select state</option>');
				$('#xa').html('<option value="">Select city</option>');
			}
		});
		$(document).on('change', '#state', function(){
			var state_id = $(this).val();
			if(state_id != '')
			{
				load_json_data('xa', state_id);
			}
			else
			{
				$('#xa').html('<option value="">Select xa</option>');
			}
		});
	});
</script>
	<script src="source/assets/dest/js/custom2.js"></script>
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
	
</body>
</html>
