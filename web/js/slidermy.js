function ddd (event, ui)
						{
						
							$('#arrFilter_P2_MIN input').val(ui.values[ 0 ]);
							$('#arrFilter_P2_MAX input').val(ui.values[ 1 ]);
						
						}
						
						function ddd2 (event, ui)
						{
							
							$('#arrFilter_P2_MINh input').val(ui.values[ 0 ]);
							$('#arrFilter_P2_MAXh input').val(ui.values[ 1 ]);
						
						}
						function ddd3 (event, ui)
						{
						
							$('#arrFilter_P2_MINw input').val(ui.values[ 0 ]);
							$('#arrFilter_P2_MAXw input').val(ui.values[ 1 ]);
						
						}
						function keyup1()
						{
							
							$p1 = $('#arrFilter_P2_MIN input').val();
							
							$( "#slideyii1" ).slider( "values", 0, $p1 );
							$num = 1;
							filtaja_posr  ($num, 1);
						}
						
						function keyup2()
						{
							$p1 = $('#arrFilter_P2_MAX input').val();
							$( "#slideyii1" ).slider( "values", 1, $p1 );
							$num = 1;
							filtaja_posr  ($num, 1);
						}
						
						function hkeyup1()
						{
							
							$p1 = $('#arrFilter_P2_MINh input').val();
							
							$( "#slideyii2" ).slider( "values", 0, $p1 );
							$num = 1;
							filtaja_posr  ($num, 2);
						}
						
						function hkeyup2()
						{
							$p1 = $('#arrFilter_P2_MAXh input').val();
							$( "#slideyii2" ).slider( "values", 1, $p1 );
							$num = 1;
							filtaja_posr  ($num, 2);
						}
						
						function wkeyup1()
						{
							
							$p1 = $('#arrFilter_P2_MINw input').val();
							
							$( "#slideyii3" ).slider( "values", 0, $p1 );
							$num = 1;
							filtaja_posr  ($num, 3);
						}
						
						function wkeyup2()
						{
							$p1 = $('#arrFilter_P2_MAXw input').val();
							$( "#slideyii3" ).slider( "values", 1, $p1 );
							$num = 1;
							filtaja_posr  ($num, 3);
						}
						