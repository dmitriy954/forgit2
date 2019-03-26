

function ff2()
						{
							var $perr, per7;

						  $perr = $(this).attr("data-id");
							//alert ($per);
							
						 var $rr;
						 var fl;
						 $rr = $('[data-id ='+$perr+'][data-type = 2 ]').val();
						//alert ($rr)	;
						
						  var reg = /\D/;

// не глобальный регэксп, поэтому ищет только первую цифру
                         if ($rr.match(reg) )
							{
								fl = $('[data-id ='+$perr+'][data-type = 2 ]').val("1");
								per7 = $('input[name=kolofbuk]').val("1");
							}
					     else 
						    {							 
						      $rr = Number($rr);
						
						      if ($rr > 1)
						        {
						            $rr = $rr -1;
						            per7 = $('input[name=kolofbuk]').val($rr);
						            fl = $('[data-id ='+$perr+'][data-type = 2 ]').val($rr);
						
						       }
						
						
							
						    }	
						//per = $("#test338").val();
						//per = Number(per);
						//per = per + 1;
						//per = $("#test338").val(per);
						}
						
function ff3( )
						{
							
							
							var $perr , per7;

						  $perr = $(this).attr("data-id");
							//alert ($per);
						 var reg = /\D/;	
						 var $rr;
						 var fl;
						 $rr = $('[data-id ='+$perr+'][data-type = 2 ]').val();
						//alert ($rr)	;
						
						if ($rr.match(reg) )
							{
								fl = $('[data-id ='+$perr+'][data-type = 2 ]').val("1");
								per7 = $('input[name=kolofbuk]').val("1");
							}
					     else 
						    {	
						
						       $rr = Number($rr);
						       if ($rr < 20)
						         {
						           $rr = $rr +1;
						
						           per7 = $('input[name=kolofbuk]').val($rr);
						           fl = $('[data-id ='+$perr+'][data-type = 2 ]').val($rr);
						         }
						
							}
							//alert ("nffjjff");
							
							//alert ($(ddd).attr("data-id") );
							//alert ($(par).attr("data-id") );
						//per = $("#test338").val();
						//per = Number(per);
						//per = per - 1;
						//per = $("#test338").val(per);
						
						
						}




function ff5()
						{
							var per, per7;
							per = $(this).val();
							
                           
                            var reg = /\D/;

// не глобальный регэксп, поэтому ищет только первую цифру
                            if (per.match(reg) )
							{
								
								per7 = $(this).val("1");
								per7 = $('input[name=kolofbuk]').val("1");
								
							}
							else
							{	
						
						       if (per < 1 || per > 20)
							    {
								  ff = $(this).val("1");
								  
							    }
								else
								{
						    $('input[name=kolofbuk]').val(per);
						 
						    per7 = $('input[name=kolofbuk]').val(per);
								}
							
							}
							
						//	alert(per);
						}

		  