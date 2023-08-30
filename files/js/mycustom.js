
$(document).ready(function(){

	var pageUrl=window.location.origin+'/case_management';

	$(window).on('scroll', function() {
	  if (window.getSelection) {
	    window.getSelection().removeAllRanges();
	  } else if (document.selection) {
	    document.selection.empty();
	  }
	});



	$('.courtTypeDelete').click(function(){
		var courtTypeID=$(this).attr('court_type_id');
		
		$('.yesDeleteCourt').click(function(){
			$.ajax({
		       method:'POST',
		       url:pageUrl+'/include/request.php',
		       data:{'courtTypeDelete':'courtTypeDelete','courtTypeID':courtTypeID},
		      success:function(response){
		      	var footer=$('.msgShow');
		        show_message(response,footer);
		      }
		    });
		});
	});

	$('.caseTypeDelete').click(function(){
		var caseTypeID=$(this).attr('case_type_id');
		
		$('.yesDeleteCase').click(function(){
			$.ajax({
		       method:'POST',
		       url:pageUrl+'/include/request.php',
		       data:{'caseTypeDelete':'caseTypeDelete','caseTypeID':caseTypeID},
		      success:function(response){
		      	var footer=$('.msgShow');
		        show_message(response,footer);
		      }
		    });
		});
	});


	$('.deleteClientCase').click(function(){
		var case_id=$(this).attr('case_id');

		$('.yesDeleteClient').click(function(){
			$.ajax({
		       method:'POST',
		       url:pageUrl+'/include/request.php',
		       data:{'deleteClientCaseDelete':'deleteClientCaseDelete','case_id':case_id},
		      success:function(response){
		      	var footer=$('.msgShow');
		        show_message(response,footer);
		      }
		    });
		});
	});


	$('.deleteClient').click(function(){
		var client_id=$(this).attr('client_id');

		$('.yesDeleteClient').click(function(){
			$.ajax({
		       method:'POST',
		       url:pageUrl+'/include/request.php',
		       data:{'deleteClient':'deleteClient','client_id':client_id},
		      success:function(response){
		      	var footer=$('.msgShow');
		        show_message(response,footer);
		      }
		    });
		});
	});


	$(".search").on("keyup", function() {

	    var value = $(this).val().toLowerCase();
	    $(".showSearchData tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	$('.addNewHearing').click(function(){

		var case_id=$(this).attr('case_id');

		$.ajax({
	       method:'POST',
	       url:pageUrl+'/include/request.php',
	       data:{'checkHearing':'checkHearing','case_id':case_id},
	      success:function(response){
	      	var response=$.parseJSON(response);

	      	if(response.error)
	      	{
	      		$('.newHearingBtn').remove();
	      	}
	        $('.newHearingInput').html(response.message);
	      }
	    });
	});

	$('#print-button').click(function() {
            var printContents = $('.printable-content').html();
            var originalContents = $('body').html();

            $('body').html(printContents);
            window.print();

            $('body').html(originalContents);
        });

	$('.viewProfile').click(function(){
		alert()
	});



	$('.form').on('submit',function(e){
		e.preventDefault();
		var form=$(this);
		submitForm(form);
	 });


	function submitForm(form)
	{
		var footer=$('.msgShow');

		footer.html('<center><img src='+pageUrl+"/files/ajax-loader.gif alt='Loader'></center>");
		var file1=form.get(0).image;
		if (file1===undefined || file1==null || file1==='') 
		{	
			$.ajax({
			url:form.attr('action'),
			method:form.attr('method'),
			data:form.serialize(),
			success:function(response){
				show_message(response,footer);
			}

	      });

		}
		else
		{
			var formData = new FormData($(form)[0]);

			$.ajax({
				method:form.attr('method'),
				url:form.attr('action'),
				data:formData,
				success:function(response){
					show_message(response,footer);
				},
				cache: false,
			    contentType: false,
			    processData: false,

			});
	   }		
	}


	function show_message(response,display)
	{
		var response=$.parseJSON(response);

		if (response.success) 
		{
			if (response.signout)
			{
				setTimeout(function(){
					window.location.reload();
				},2000);
			}
			else if (response.url) 
			{
				setTimeout(function(){
					window.location=response.url;
				},2000);
			}

			display.html('<div class="alert alert-success alert-dismissible fade show d-flex justify-content-center" role="alert">'+response.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button></div>');
		}
		else if(response.error)
		{
			if (response.url) 
			{
				setTimeout(function(){
					window.location=response.url;
				},2000);
			}

			display.html('<div class="alert alert-danger alert-dismissible fade show d-flex justify-content-center" role="alert">'+response.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button></div>');
		}
	}
});