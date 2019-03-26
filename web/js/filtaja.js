function filtaja ($num, $por, $addr)
	{
		var $p1, $p2, $p3, $p4, $p5, $p6, $p7;
	//	alert ($num);
	//	alert ($por);
	//	alert ($addr);
		$p1 = $('#arrFilter_P2_MIN input').val();
		$p2 = $('#arrFilter_P2_MAX input').val();
		$p3 = $('#arrFilter_P2_MINh input').val();
		$p4 = $('#arrFilter_P2_MAXh input').val();
		$p5 = $('#arrFilter_P2_MINw input').val();
		$p6 = $('#arrFilter_P2_MAXw input').val();
		$p7 = $('#idofcateg input').val();
		$p8 = $('#searchforajaid input').val();
	//	alert ($p6);
							
							
						//	$st9 = 'p1=' + $p1 +', p2=' + $p2 + ', p3=' + $p3 + ', p4=' + $p4 + ' , p5=' + $p5 + ', p6=' + $p6;
							
							
						//	alert ($st9);
		$.ajax({
	
	
	    type: "POST",
            url: '' + $addr,
            data: 'p1=' + $p1 + '&p2=' + $p2 + '&p3=' + $p3 + '&p4=' + $p4 + '&p5=' + $p5 + '&p6=' + $p6 + '&p7=' + $p7 + '&p8=' + $p8,
	
    
	
       complete: function(jqXHR, textStatus) {
        if (textStatus == 'success') { 
		  //alert(jqXHR.responseText);
		  resp = jqXHR.responseText;
	//	 alert (resp);
		 
		 $('.bx-filter-popup-result').css ("display", "none");
		 
	    if (document.documentElement.clientWidth > 768)
	      {
		   if ($por == 1)
		     {
			$('#modef1').css ("display", "inline-block");
		      }
		   if ($por == 2)
		     {
			 $('#modef2').css ("display", "inline-block");
		     }
		    if ($por == 3)
		      {
			 $('#modef3').css ("display", "inline-block");
		      }
		 
	       }
		 if (document.documentElement.clientWidth < 768)
		 {
		     $('#modeffix').css ("display", "block");
		 }
		  
		  $('.modef_num').html (resp);
		  
		}
		
		 if (textStatus == 'error') {
           // alert('Ошибка.');
        }
	}
	});
							
							
							
							
							
							
						}