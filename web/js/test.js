function ff2($perr)
						{

							var $flagchange = 1; // ���� � ���� ����� ��� �������� ������ �������, �� ��������� �� ������

						 var $rr;
						 var fl;
						 $rr = $('[data-id ='+$perr+'][data-type = 2 ]').val();
						//alert ($rr)	;
						
						  var reg = /\D/;

// �� ���������� �������, ������� ���� ������ ������ �����
                        $flag = 0;
						$flag = sito ($rr);
						
						
						if ($flag == 1 )
							{
								//alert ($rr);
								//fl = $('[data-id ='+$perr+'][data-type = 2 ]').val("1");
								$rr = "1";
								changecolumnandtotal ($perr, $rr);
							}
					     else 
						    {	
                             					
						       $rr = Number($rr);
						       if ($rr != 1) 
							      {
						             $rr = $rr -1;
						             change_data ($rr, $perr, 2)	
								  }
							}
						}
						
	function ff3($perr)
						{
							
							
						
							//alert ($per);
						 var reg = /\D/;	
						 var $rr;
						 var fl;
						 var $diff;
						 $rr = $('[data-id ='+$perr+'][data-type = 2 ]').val();
						//alert ($rr)	;
						$flag = 0;
						$flag = sito ($rr);
						if ($flag == 1)
						{
							$rr = "1";
						}
						
						if ($flag == 1 )
							{
								//alert ($rr);
								//fl = $('[data-id ='+$perr+'][data-type = 2 ]').val("1");
								changecolumnandtotal ($perr, $rr);
							}
					     else 
						    {	
						
						$rr = Number($rr);
						$rr = $rr +1;
						   change_data ($rr, $perr, 1)
						
						
							}				   
						
						}
						
						
function change_data ($rr, $perr, pl_or_min)	
{
	                   fl = $('[data-id ='+$perr+'][data-type = 2 ]').val($rr);
							
							
					   $price = $('[data-id ='+$perr+'][data-type = 21]').html();
					   $price = $price.replace(/\D/g, ""); 
					   $price = $price.replace(/\s/g, ""); // ������ �������
					   $price = Number ($price);
					   $tot = $rr * $price;
					 
					   $tot = String ($tot);
					   $tot2 = $tot;
					   $tot2 = $tot2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
					   $tot2 = $tot2 + " ���."
					   fl = $('[data-id ='+$perr+'][data-type = 11 ]').html($tot2);
					   
					   var $hideinput;
					   
					   $hideinput = $('input[name=listchange]').val();
					   
					   
					   var $retstr = change_listchange($hideinput, $perr, $rr);
					   // alert ($retstr);  
					   
					  vv = $('input[name=listchange]').val($retstr);
							   
					  $summoftovs = $("div[data-type = '12']").find('span');
									 
					  $value_summoftovs = $summoftovs.html();
					 
					  $value_summoftovs = $value_summoftovs.replace(/\D/g, ""); 
					  $value_summoftovs = $value_summoftovs.replace(/\s/g, ""); // ������ �������
					  $value_summoftovs = Number($value_summoftovs);
					  if (pl_or_min == 1)
							{
					              $value_summoftovs = $value_summoftovs + $price;
							}
                      else 
							{
								  $value_summoftovs = $value_summoftovs - $price;
							} 
					  $value_summoftovs = String ($value_summoftovs);  // ����� �����
					  $value_summoftovs_2 = $value_summoftovs;
					  $value_summoftovs = $value_summoftovs.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
						// ����� ����� ����� � "�����" . � ����� ������ � ����� � ����������� ������ � ������� ��� ����� ���������
					  $("div[data-type = '12']").find('span').html($value_summoftovs);
					  $("div[data-type = '13']").find('span').html($value_summoftovs);
					  $("form input[name = totalinp]").val($value_summoftovs_2);	
	
}


						
// ���� ��� ������� ������. ������ �� �������: ������ ������ �� ������� �� ������ � ��� �������� ���������� �� ������ �������� �������� ���������� ������
// ������ - ������ � ��������: �� ������ � ��� ����� ���������� 
// $perr - ��� dataid , $rr - ����� ����������
// ��� ������� ������ ������ �����	 (������ � ��������: �� ������ � ��� ����� ����������)

					
function change_listchange ($hideinput, $perr, $rr) {
	
	
	                    var arr = [];
					   var arr2 = [];
					   var arr3 = [];
					   var len = 0;
					   var ff;
					   var stelem;
					   var $retstr;
					   var vv;
					   
					   
					   
					   
					   // ��� ����������� ����������� ��� ����� ����� ������. �� ������ � ��� ���������� ����������� xx , � ������ gg
					
					   ff = 0;
					   if ($hideinput.length > 3) // ���� � ������ ���� ���� ���� ������
					      {
							//alert ("������ 3") ; 
							arr =  $hideinput.split('gg') ; // ������ �������, � ������ �� ������� ������ ( �� ������ , �����������, ���-��)
							//alert (arr[0]) ; 
							len = arr.length;
							//alert (len);
							for (var y = 0; y < len; y++)  // ���� �� ���� �������
							   {
								  stelem = arr[y];  // ������� ������
								  arr2 =  stelem.split('xx') ; // ������� �� �� � ����������
								  if (arr2[0] == $perr)  // ���� �� ������� � ������ ����
								     {
									   arr2[1] = $rr; // ������ ����������
									   stelem = arr2.join('xx'); // ������� � ������
									   arr[y] = stelem; // ������ ������ � ������� �������
									   ff = 1;
								     }
								
							   }
							
						
						  }
						  
						if  (ff == 0)  // ���� �� ����� ��� ��� �� ���� �� ����� ��������� ���������� ��� ���� ����� ������
							    {
									
								   arr3[0] = $perr;
								   arr3[1] = $rr;
								   stelem = arr3.join('xx');
								   
								   
								 
								   arr = arr.concat (stelem);  // ��������� ����� ������ � ������
								   //alert (arr[0]);
								 
							    }
						$retstr = arr.join('gg');  // ��������������� ������� � ������

                         return	$retstr;					 
	
}	



function sito (kolfrominput)
{
	var reg = /\D/;
	
	var tekkol = kolfrominput;
	var flag = 0;
                             
// �� ���������� �������, ������� ���� ������ ������ �����

                            
	
    if (kolfrominput.match(reg) )
	  {
							
		tekkol = 1;
		flag = 1;
	  }
	else
	  {	
		kolfrominput = Number(kolfrominput);
		if (kolfrominput > 20)
			{
							
				tekkol = 1;
				flag = 1;
								
			}
							
		if (kolfrominput < 1)
			{
							
				tekkol = 1;
				flag = 1;
			}

	  }
							//kolfrominput = $(this).val();
							
	
	return (flag);
	
}

// ������� �������� �� ��������� ����� � ������ ������� ������� � ����� �� ��������� ����� �����
function changecolumnandtotal (id, kolfrominput)
{
	   
                            var reg = /\D/;
							
							
							flag = sito (kolfrominput);
							
							if (flag==1)
							{
								tekkol = "1";
								
							}
							else 
							{
								tekkol = kolfrominput;
								
							}
							
							$('[data-id='+id+'][data-type = 2]').val(tekkol); // ���� ���������� ������ ������� ������
							
							
							////////////
							changecolumnsum (id, tekkol); // ��������� ����� � ��������������� ������ ������� �������
							 
						//////////////////	
							 var $hideinput;
					         $hideinput = $('input[name=listchange]').val();
					   
					 //  alert ($hideinput);
					        var $retstr = change_listchange($hideinput, id, tekkol); // ��������� �������� ������ � ����� � ������ ������������
						//	alert($retstr);
							vv = $('[data-type = 31 ]').val($retstr);
						
							strishod = $('input[name=strishodidkol]').val(); // ��� � �������� ����������
							strchange = $('input[name=listchange]').val();  // ��� � ���������� ���-��
						
							tots = ftotalsum (strishod, strchange, id);
						
							$bbb = tots;
							
						    $bbb = String ($bbb);
							$bbb2 = $bbb;
							
					  $bbb = $bbb.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 '); // ������ ������
					  
					  //$str = "--" + $bbb + "--";
						//	alert ($str);
					  
					  $("div[data-type = '12']").find('span').html($bbb);
					  $("div[data-type = '13']").find('span').html($bbb);
					  $("form input[name = totalinp]").val($bbb2);	
							
							
	
}

// ��������� ����� � ��������������� ������ ������� �������						
function changecolumnsum (id, tekkol)
{
	
	$price = $('[data-id ='+id+'][data-type = 21]').html();
	//alert ($price);
	// � ���������� ����� ������ ���-�� ���� 4 500 ���.  �� ������� � �� ���. ���� ����������
	$price = $price.replace(/\D/g, ""); 
	$price = $price.replace(/\s/g, ""); // ������ �������
	$price = Number ($price);
	$tot = tekkol * $price;
							
							
							
							
					 
	$tot = String ($tot);
	$tot2 = $tot;
	$tot2 = $tot2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 '); // ���������� ������� 
	$tot2 = $tot2 + " ���."
	fl = $('[data-id ='+id+'][data-type = 11 ]').html($tot2);
	
	
}

// $perr - ��� ��
						
function ftotalsum (strishod, strchange, $perr)
{
	var flag1 = 1, arr = [], arr2 = [], arr11 = [], arr12 = [];
	var totals = 0;
	if (strchange.length < 2) // ���� �� ������ � ������ � ��������� ������������ �������
	 {
		flag1 = 0; 
		
	 }
	 else
	 {
		arr2 =  strchange.split('gg') ; 
		 
	 }
	if (strishod.length > 1)  // �� ������ ������, ���� �� ������ � �������� ������ (�������� ���-��)
					      {
							//alert ("������ 3") ; 
							arr =  strishod.split('xxx') ; // ������ �������, � ������ �� ������� ������ ( �� ������ , �����������, ���-��)
							
							//alert (arr[0]) ; 
							len = arr.length;
							//alert (len);
							for (var y = 0; y < len; y++)  // ���� �� ���� �������
							   {
								   
								  stelem = arr[y];  // ������� ������
								 // alert(len);
								 // alert (stelem);
								  arr11 =  stelem.split('ddd') ; // ������� �� �� � ����������
								  
								  id = arr11[0];
								  kol = arr11[1];
								  pr = $('[data-id ='+id+'][data-type=21]').html(); // ����� ����
								 // alert ("gh");
								  if (flag1 == 1)  // ���� � ������ � ����� � ����������� ������������ �� ��� ���� ������
								  {
									  
									len2 = arr2.length;  // ��� ����� ������������� ���� ������ ����� � �������
									//alert (len2);
									//arr12 =  stelem.split('gg') ; 
									for (var yy = 0; yy < len2; yy++)  // ���� �� ���� �������
							          {
								        stelem22 = arr2[yy];  // ������� ������
								      
								        arr22 =  stelem22.split('xx') ;
										
										if (arr22[0] == arr11[0]) // ���� ���� ���������� ���� � ���� �������
										{
										   kol = arr22[1]; // ����� ���������� �� ������� ������. ����� � ������ ������� �� ���� ����� ����� �������� � ���������
										   // ��� ��� ����� ������ ����� ����������
										}
									  }
				 
								  }
								  // ���� ����� ����, ������� ��������� ���. � �������
								  pr = pr.replace(/\D/g, ""); 
					  pr = pr.replace(/\s/g, ""); // ������ �������
					  pr = Number(pr);
					  
					  totals = totals + pr*kol; // � �������� ���������� �����
								
								
							   }
							
						
						  }
						  
						
						//$retstr = arr.join('gg');  // ��������������� ������� � ������
						return (totals);
	
}	

				