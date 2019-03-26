<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\jui\DatePicker;
use yii\widgets\Breadcrumbs;

//echo $post['listchange'];



echo Breadcrumbs::widget([
    'itemTemplate' => "<li>{link}</li>\n", // template for all links
    'links' => [
        
        ['label' => 'Корзина', 'url' => ['cart/index']],
        'Ввод данных',
    ],
]);

?>	

<h1 id="pagetitle" class="dbg_title">Оформление заказа</h1>

<div class = "order_make">
   
<?   $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-inline myform'],
	'fieldConfig' => [
	'errorOptions' => ['class' => 'help-block help-block-error err40'],
	]
]) ?>
 <?= $form->field($model, 'idt', ['labelOptions' => ['class' => 'hidelabelmy']])->hiddenInput(['value' => $idt]);  ?>
  <?= $form->field($model, 'controlst', ['labelOptions' => ['class' => 'hidelabelmy']])->hiddenInput(['value' => $controlst]);   ?>
    
    <div class = "sectionmarg">
	  <div class = "row">
	  	  <div class="col-md-6">
		     <div class = "section_title_green">
			    <h4> Ваши данные </h4>
			 </div>
			 
			 <div id="sale_order_props">
			 
			   
			      <?= $form->field($model, 'name', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone mylabelred']])->textInput()->label('Как вас зовут?') ?>
				   
			      <?= $form->field($model, 'email', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone mylabelred']])->input('email')->label('Введите емайл') ?>
			      <?= $form->field($model, 'mobile', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone mylabelred']])->textInput()->label('Мобильный телефон')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => ['+7 (999) 999 99 99'],
	      ]) ?>
	
			</div>
			 
			 
		     
		  </div>
		  
		  <div class="col-md-6">
		   <div class = "section_title_green">
			    <h4> Куда доставить </h4>
		   </div>
		   
		   <div id="sale_order_props2">
		   
		       
			      <?= $form->field($model, 'town', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone mylabelred']])->textInput()->label('Город: ') ?>
			      <?= $form->field($model, 'street', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone mylabelred']])->textInput()->label('Улица: ') ?>
			      <?= $form->field($model, 'house', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone mylabelred']])->textInput()->label('Дом: ') ?>
				  <?= $form->field($model, 'kvoret', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone']])->textInput()->label('Квартира или этаж: ') ?>
			 
		   
		   
		   
		   </div>
		
         </div>		
		  
		
		  
		  
	  </div>
	  
	  	
	</div>
	
	
	<div class = "sectionmarg">
	   <div class = "section_title_full">
	      <h4>Когда и кому доставить</h4>
	   
	   </div>
	<?php $model->whentime = 0; ?>
	   <div class="row">
          <div class="col-md-6"> 
		      <?= $form->field($model,'datemy', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone']])->widget(DatePicker::className(), ['language' => 'ru',
    'dateFormat' => 'dd-MM-yyyy'])->textInput()->label('Дата доставки: ') ?>
	
	<?= $form->field($model, 'whentime', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone']])->dropdownList([
        0 => 'Бесплатно в течении дня (с 9:00 до 19:00)', 1 => '12:00',  2 => '13:00', 3 => '14:00', 4 => '15:00', 5 => '16:00', 6 => '17:00',
		7 => '18:00', 8 => '19:00', 9 => '20:00', 10 => '21:00', 11 => '22:00',
    ]
   
)->label('Время доставки: ');  ?>
		    
		  </div>
          <div class="col-md-6">
		  <?= $form->field($model, 'mobileto', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone']])->textInput()->label('Мобильный телефон')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => ['+7 (999) 999 99 99'],
	      ]) ?>
		   <?= $form->field($model, 'nametaker', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label mylabelone']])->textInput()->label('Имя получателя: ') ?>
		  
		  
		  </div>
          <div class="col-md-12">
		    <?= $form->field($model, 'textotkr', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label2 mylabeltwo clearfix'], 'inputOptions' => ['class' => 'form-control form-control2']])->textarea(['rows' => '7'])->label('Текст открытки'); ?>
		  
		  </div>
       </div>
	
	</div>
	
	
		  <div class="row">
         <div class="col-md-6 spdost">
		    <div class = "sectionmarg">
			   <div class = "section_title_green">
			      <h4> Способ доставки </h4>
		       </div>
			   
			   <div class = "block_w100_ris clearfix">
			   
			    <div class = "bx_element labelinsure">
				  <input id="ID_DELIVERY_ID_27" name="DatasOrder[dost]" value="1"  type="radio" checked onchange = "ff22()">
			      <label for="ID_DELIVERY_ID_27">
                      <div class="bx_logotype">
					    <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/car1.gif"; echo $st; ?>)"></div>
					  </div>
                      <div class="bx_description">
					  
					    <strong onclick="">
                           <div class="name">
                              <strong>Доставка в пределах СПб</strong>
                           </div>
						   <span class="bx_result_price">
                                Стоимость:
                                <b>0 руб.</b>
                           </span>
                        </strong>
						 
					  </div>
                  </label>
				  
				  
				</div> 
			   
			   </div>
			   
			   
			   
			   
			   
			   
			   <div class = "block_w100_ris clearfix">
			   
			    <div class = "bx_element labelinsure">
				  <input id="ID_DELIVERY_ID_21" name="DatasOrder[dost]" value="2"  type="radio" onchange = "ff22()">
			      <label for="ID_DELIVERY_ID_21">
                      <div class="bx_logotype">
					    <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/car1.gif"; echo $st; ?>)"></div>
					  </div>
                      <div class="bx_description">
					  
					    <strong onclick="">
                           <div class="name">
                              <strong>Самовывоз</strong>
                           </div>
						   <span class="bx_result_price">
                                Стоимость:
                                <b>0 руб.</b>
                           </span>
                        </strong>
						 
					  </div>
                  </label>
				  
				  
				</div> 
			   
			   </div>
			
			
			</div>
		    
		 
		 </div>
         <div class="col-md-6 my_pay">
		    <div class = "sectionmarg">
			
			   <div class = "section_title_green">
			      <h4> Способ оплаты </h4>
		       </div>
			   
			   <div class = "row">
			     <div class="col-md-4 col-sm-6 col-xs-6">
                   <div class="bx_block horizontal">
				      <div class="bx_element labelinsure">
					      <input id="ID_DELIVERY_ID_32" name="DatasOrder[oplata]" value="1"  type="radio" checked onchange = "ff22()">
			              <label for="ID_DELIVERY_ID_32">
                             <div class="bx_logotype">
					           <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/visa.gif"; echo $st; ?>)"></div>
					         </div>
					         <div style="clear: both"></div>
                             <div class="bx_description">
					            Банковские карты
					         </div>
                          </label>
		   
			          </div>
				   </div>
                 </div>	


<div class="col-md-4 col-sm-6 col-xs-6">
                   <div class="bx_block horizontal">
				      <div class="bx_element labelinsure">
					      <input id="ID_DELIVERY_ID_33" name="DatasOrder[oplata]" value="2"  type="radio" onchange = "ff22()">
			              <label for="ID_DELIVERY_ID_33">
                             <div class="bx_logotype">
					           <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/cash.jpg"; echo $st; ?>)"></div>
					         </div>
					         <div style="clear: both"></div>
                             <div class="bx_description">
					            Наличные курьеру
					         </div>
                          </label>
		   
			          </div>
				   </div>
                 </div>			

<div class="col-md-4 col-sm-6 col-xs-6">
                   <div class="bx_block horizontal">
				      <div class="bx_element labelinsure">
					      <input id="ID_DELIVERY_ID_34" name="DatasOrder[oplata]" value="3"  type="radio" onchange = "ff22()">
			              <label for="ID_DELIVERY_ID_34">
                             <div class="bx_logotype">
					           <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/qiwi.jpg"; echo $st; ?>)"></div>
					         </div>
					         <div style="clear: both"></div>
                             <div class="bx_description">
					            Оплата QIWI
					         </div>
                          </label>
		   
			          </div>
				   </div>
                 </div>			

<div class="col-md-4 col-sm-6 col-xs-6">
                   <div class="bx_block horizontal">
				      <div class="bx_element labelinsure">
					      <input id="ID_DELIVERY_ID_35" name="DatasOrder[oplata]" value="4"  type="radio" onchange = "ff22()">
			              <label for="ID_DELIVERY_ID_35">
                             <div class="bx_logotype">
					           <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/mob.jpg"; echo $st; ?>)"></div>
					         </div>
					         <div style="clear: both"></div>
                             <div class="bx_description">
					            Мобильный телефон
					         </div>
                          </label>
		   
			          </div>
				   </div>
                 </div>			

<div class="col-md-4 col-sm-6 col-xs-6">
                   <div class="bx_block horizontal">
				      <div class="bx_element labelinsure">
					      <input id="ID_DELIVERY_ID_36" name="DatasOrder[oplata]" value="5"  type="radio" onchange = "ff22()">
			              <label for="ID_DELIVERY_ID_36">
                             <div class="bx_logotype">
					           <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/webmoney.gif"; echo $st; ?>)"></div>
					         </div>
					         <div style="clear: both"></div>
                             <div class="bx_description">
					            Электронные деньги
					         </div>
                          </label>
		   
			          </div>
				   </div>
                 </div>			

<div class="col-md-4 col-sm-6 col-xs-6">
                   <div class="bx_block horizontal">
				      <div class="bx_element labelinsure">
					      <input id="ID_DELIVERY_ID_31" name="DatasOrder[oplata]" value="6"  type="radio" onchange = "ff22()">
			              <label for="ID_DELIVERY_ID_31">
                             <div class="bx_logotype">
					           <div style = "background-image: url(<?php $st = Yii::getAlias('@web'); $st = $st .  "/images/term.gif"; echo $st; ?>)"></div>
					         </div>
					         <div style="clear: both"></div>
                             <div class="bx_description">
					            Терминалы 
					         </div>
                          </label>
		   
			          </div>
				   </div>
                 </div>							 
			   
			   
			   </div>
			
			</div>
			
			
		 </div>
		 
		 
		
		   <div class = "col-md-12">
		      <div class = "sectionmarg">
			    <h4>Комментарии к заказу:</h4>
				     <div class = "block_w100_ris clearfix">
					     <?= $form->field($model, 'textcomment', ['options' => ['class' => 'myfield1 clearfix'], 'labelOptions' => ['class' => 'control-label2 mylabeltwo clearfix hidelabelmy'], 'inputOptions' => ['class' => 'form-control form-control2']])->textarea(['rows' => '7'])->label('Текст открытки'); ?>
		  
					 
					 </div>
			
			  </div>
			
		  </div>
		 
		 <div style="clear: both;"></div>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
     </div>
	 
	 
	 <div class = "bx_ordercart_order_pay">
	   <div class = "row">
	      <div class="bx_ordercart_order_pay_right col-sm-4 col-sm-offset-4">
	   
	         <ul class="list-inline total-result">
                <li>
				    <?php $tot = number_format($tot, 0, '', ' ');  ?>
				    <h4>Товаров на:</h4>
                    <div class="total-result-in"> <?php echo $tot ?> руб. </div>
				
				</li>
                <li class="divider"></li>
                <li class="total-price">
				    <h4>Итого:</h4>
                    <div id="allSum_FORMATED" class="total-result-in"> <?php echo $tot ?> руб. </div>
				
				</li>
             </ul>
	   
	      </div>
	   </div>

	 </div>
	
	
	<div class="center-block bx_ordercart_order_pay_center" style="max-width:400px; margin-bottom: 25px;">
	
            <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success btn-lg btn-block']) ?>
       
	</div>
	
  
<?php ActiveForm::end() ?>
<script>

$(document).ready(init);
		 function init(){
		 
		  $('#datasorder-mobile').inputmask({"mask": "+7 (999) 999 99 99"});
		  
		 // $('#datasorder-mobile').inputmask('999[-AAA]');
		 }	
		 
// удалить эту функцию и ссылки в коде на нее
function ff22() {
	
	var pp;
	pp = $('input[name=Dat]:checked').val();
	
	//alert (pp);
}
</script>
   
  
</div>