function ff2($perr)
						{

							var $flagchange = 1; // если в поле буквы или значение меньше единицы, то показания не менять

						 var $kolfrominput;
						 var fl;
						 $kolfrominput = $('[data-id ='+$perr+'][data-type = 2 ]').val();
						//alert ($rr)	;
// при клике на минус эта функция не даст выйти количество за пределы, так как ниже реализована проверка. и функция сито в данном
//  случае просто нужна на тот случай если пользователь что-то непосредственно ввел в инпут.
// функция же ff3 действует несколько иначе. Она позволяет выйти количеству за верхний предел и количество уже сбросится в единицу
// функцией сито						
						
						  var reg = /\D/;

// не глобальный регэксп, поэтому ищет только первую цифру
                        $flag = 0;
						$flag = sito ($kolfrominput);
						
						
						if ($flag == 1 )
							{
						
								$kolfrominput = "1";
								changecolumnandtotal ($perr, $kolfrominput);
								// если флаг = 0 , то при изменении количества на 1 можно к общим суммам просто
								// прибавить или вычесть цену товара. Если  же флаг = 1, то в инпуте что-то не то
								// И нужно все пересчитывать заново. для этого и предназначена функция выше.
							}
					     else 
						    {	
                             					
						       $kolfrominput = Number($kolfrominput);
						       if ($kolfrominput != 1) 
							      {
						             $kolfrominput = $kolfrominput -1;
						             change_data ($kolfrominput, $perr, 2)	
								  }
							}
						}
						
	function ff3($perr)
						{
							
							
						
							//alert ($per);
						 var reg = /\D/;	
						 var $kolfrominput;
						 var fl;
						 var $diff;
						 $kolfrominput = $('[data-id ='+$perr+'][data-type = 2 ]').val();
						//alert ($rr)	;
						$flag = 0;
						$flag = sito ($kolfrominput);
						if ($flag == 1)
						{
							$kolfrominput = "1";
						}
						
						if ($flag == 1 )
							{
								//alert ($rr);
								//fl = $('[data-id ='+$perr+'][data-type = 2 ]').val("1");
								changecolumnandtotal ($perr, $kolfrominput);
							}
					     else 
						    {	
						
						      $kolfrominput = Number($kolfrominput);
						      $kolfrominput = $kolfrominput +1;
						      change_data ($kolfrominput, $perr, 1)
						
						
							}				   
						
						}
						
						
function change_data ($rr, $perr, pl_or_min)	
{
	                   fl = $('[data-id ='+$perr+'][data-type = 2 ]').val($rr);
							
							
					   $price = $('[data-id ='+$perr+'][data-type = 21]').html();
					   $price = $price.replace(/\D/g, ""); 
					   $price = $price.replace(/\s/g, ""); // убрать пробелы
					   $price = Number ($price);
					   $tot = $rr * $price;
					 
					   $tot = String ($tot);
					   $tot2 = $tot;
					   $tot2 = $tot2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
					   $tot2 = $tot2 + " руб."
					   fl = $('[data-id ='+$perr+'][data-type = 11 ]').html($tot2);
					   
					   var $hideinput;
					   
					   $hideinput = $('input[name=listchange]').val();
					   
					   
					   var $retstr = change_listchange($hideinput, $perr, $rr);
					   // alert ($retstr);  
					   
					  vv = $('input[name=listchange]').val($retstr);
							   
					  $summoftovs = $("div[data-type = '12']").find('span');
									 
					  $value_summoftovs = $summoftovs.html();
					 
					  $value_summoftovs = $value_summoftovs.replace(/\D/g, ""); 
					  $value_summoftovs = $value_summoftovs.replace(/\s/g, ""); // убрать пробелы
					  $value_summoftovs = Number($value_summoftovs);
					  if (pl_or_min == 1)
							{
					              $value_summoftovs = $value_summoftovs + $price;
							}
                      else 
							{
								  $value_summoftovs = $value_summoftovs - $price;
							} 
					  $value_summoftovs = String ($value_summoftovs);  // общая сумма
					  $value_summoftovs_2 = $value_summoftovs;
					  $value_summoftovs = $value_summoftovs.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
						// далее обшая сумма и "итого" . В нашем случае в связи с отсутствием скидок и купонов эти суммы совпадают
					  $("div[data-type = '12']").find('span').html($value_summoftovs);
					  $("div[data-type = '13']").find('span').html($value_summoftovs);
					  $("form input[name = totalinp]").val($value_summoftovs_2);	
	
}


						
// есть два скрытых импута. первый со строкой: записи каждая из которых ид товара и его исходное количество на момент открытия страницы оформления заказа
// второй - строка с записями: ид букета и его новое количество 
// $perr - это dataid , $rr - новое количество
// эта функция меняет второй инпут	 (строка с записями: ид букета и его новое количество)

					
function change_listchange ($hideinput, $perr, $rr) {
	
	
	                   var arr = [];
					   var arr2 = [];
					   var arr3 = [];
					   var len = 0;
					   var ff;
					   var stelem;
					   var $retstr;
					   var vv;
					   
					   
					   
					   
					   // тут формируется стандартная для этого сайта строка. ид букета и его количество разделяются xx , а записи gg
					
					   ff = 0;
					   if ($hideinput.length > 3) // если в инпуте есть хоть одна запись
					      {
						//	alert ("больше 3") ; 
							arr =  $hideinput.split('gg') ; // массив записей, в каждой из которой строка ( ид букета , разделитель, кол-во)
							//alert (arr[0]) ; 
							len = arr.length;
							//alert (len);
							for (var y = 0; y < len; y++)  // идем по всем записям
							   {
								  stelem = arr[y];  // выбрали запись
								  arr2 =  stelem.split('xx') ; // разбили на ид и количество
								  if (arr2[0] == $perr)  // если ид нашелся в списке идов
								     {
									   arr2[1] = $rr; // меняем количество
									   stelem = arr2.join('xx'); // обратно в строку
									   arr[y] = stelem; // меняем запись в массиве записей
									   ff = 1;
								     }
								
							   }
							
						
						  }
						  
						if  (ff == 0)  // если по этому иду еще не было до этого изменений количества или если инпут пустой
							    {
								  // alert ("меньше 3") ; 	
								   arr3[0] = $perr;
								   arr3[1] = $rr;
								   stelem = arr3.join('xx');
								   arr = arr.concat (stelem);  // добавляем новую строку в массив
								
							    }
						$retstr = arr.join('gg');  // преобразовываем обратно в строку
                      //  alert ($retstr);
                         return	$retstr;					 
	
}	



function sito (kolfrominput)
{
	var reg = /\D/;
	
	var tekkol = kolfrominput;
	var flag = 0;
                             
// не глобальный регэксп, поэтому ищет только первую цифру

                            
	
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

// функция отвечает за изменения суммы в строке таблицы товаров а также за изменение общей суммы
// причем пересчитывает все заново.
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
						
							$('[data-id='+id+'][data-type = 2]').val(tekkol); // поле количество строки (соответствуюещего) таблицы меняем
							
							changecolumnsum (id, tekkol); // изменение суммы в соответствующей строке таблицы товаров
						
							 var $hideinput;
					         $hideinput = $('input[name=listchange]').val();
					   
					        var $retstr = change_listchange($hideinput, id, tekkol); // изменение значение инпута с идами и новыми количествами
						//	alert($retstr);
							vv = $('[data-type = 31 ]').val($retstr);
						
							strishod = $('input[name=strishodidkol]').val(); // иды и исходные количества
							strchange = $('input[name=listchange]').val();  // иды и измененные кол-ва
							
						    // тут пересчет общей цены. для этого как раз и есть в скрытом инпуте помимо строки с измененными количествами
							// строка с исходными количесвтами
							tots = ftotalsum (strishod, strchange, id);
						
							$bbb = tots;
							
						    $bbb = String ($bbb);
							$bbb2 = $bbb;
							
					  $bbb = $bbb.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 '); // пробел делаем
					  
					  //$str = "--" + $bbb + "--";
						//	alert ($str);
					  
					  $("div[data-type = '12']").find('span').html($bbb);
					  $("div[data-type = '13']").find('span').html($bbb);
					  $("form input[name = totalinp]").val($bbb2);	
							
							
	
}

// изменение суммы в соответствующей строке (соответствующий товар, по которому производилось изменение кол-ва) таблицы товаров						
function changecolumnsum (id, tekkol)
{
	$price = $('[data-id ='+id+'][data-type = 21]').html();
	
	// в переменной прайс сейчас что-то типа 4 500 руб.  От пробела и от руб. надо избавиться
	$price = $price.replace(/\D/g, ""); 
	$price = $price.replace(/\s/g, ""); // убрать пробелы
	$price = Number ($price);
	$tot = tekkol * $price;
			 
	$tot = String ($tot);
	$tot2 = $tot;
	$tot2 = $tot2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 '); // добавление пробела 
	$tot2 = $tot2 + " руб."
	fl = $('[data-id ='+id+'][data-type = 11 ]').html($tot2);
	
	
}

// $perr - это ид
						
function ftotalsum (strishod, strchange, $perr)
{
	var flag1 = 1, arr = [], arr2 = [], arr11 = [], arr12 = [];
	var totals = 0;
	if (strchange.length < 2) // есть ли записи в импуте с изменными количествами букетов
	 {   flag1 = 0;   }
	else  {   arr2 =  strchange.split('gg') ;    }
	
	if (strishod.length > 1)  // на всякий случай, есть ли записи в исходном импуте (исходные кол-ва)
			{
						
							arr =  strishod.split('xxx') ; // массив записей, в каждой из которой строка ( ид букета , разделитель, кол-во)
							len = arr.length;
							
							for (var y = 0; y < len; y++)  // идем по всем записям
							   {
								   
								  stelem = arr[y];  // выбрали запись
								  arr11 =  stelem.split('ddd') ; // разбили на ид и количество
								  
								  id = arr11[0];
								  kol = arr11[1];
								  pr = $('[data-id ='+id+'][data-type=21]').html(); // берем цену
								 // alert ("gh");
								  if (flag1 == 1)  // если в инпуте с идами и измененными количествами по этим идам есть записи
								  {
									  
									len2 = arr2.length;  // это ранее преобразовали этот второй инпут в массив
								
									for (var yy = 0; yy < len2; yy++)  // идем по всем записям
							          {
								        stelem22 = arr2[yy];  // выбрали запись
								      
								        arr22 =  stelem22.split('xx') ;
										
										if (arr22[0] == arr11[0]) // если есть совпадение идов в двух инпутах
										{
										   kol = arr22[1]; // берем количество со второго инпута. ранее в другой функции мы этот втрой инпут обновили и сохранили
										   // так что здесь просто берем количество
										}
									  }
				 
								  }
								  // выше взята цена, убираем окончание руб. и проблеы
								  pr = pr.replace(/\D/g, ""); 
					              pr = pr.replace(/\s/g, ""); // убрать пробелы
					              pr = Number(pr);
					  
					              totals = totals + pr*kol; // циклично прибавляем суммы

							   }
			
			}
						  
						
						//$retstr = arr.join('gg');  // преобразовываем обратно в строку
		return (totals);
	
}	

				