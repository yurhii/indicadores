<div class="row">
    
<!--     <div class="col-xs-6 col-sm-4">-->
<div class="col-md-5">
         <center>SELECCIONAR SECTOR(ES)</center>
    <div class="panel panel-success" style="border: 1.5px solid; border-color: #4cae4c;">
            <div class="panel-body">
                <form id="form-sector"> <!--INICIO PAR CARGAR INDICADORES-->
                  <div style="overflow: auto; height:410px; width: 100%; ">
                      <table class="table table-first-column-number data-table display full">  
                          <thead>
                              <tr>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                  <?php 
		foreach($query as $value)
		{
		?>
                          <tr>
                              <td>
                              <input type="checkbox" name="listaSector[]" value="<?php echo $value->idfuenteinformacion; ?>">
                              </td> 
                              <td>
                                  <?php echo $value->nombresector; ?>
                              </td>
                              <td hidden="">
                                  <?php echo $value->sigla; ?>
                              </td>
                          </tr>
        
		<?php
		}
		?>  
                        </tbody>
                      </table>
                  </div>
 
                    
                    <br>
                    <center>
                        <button type="button" id="btnListar" class="btn btn-success">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            Mostrar Indicadores
                        </button>
                    </center>
                  </form> <!--fin form para cargar indicadores-->
                    
            </div>
    </div>
</div>

    <div class="col-md-7">

        <center>SELECCIONAR INDICADOR(ES)</center>
        <div class="panel panel-primary" style="border: 1.5px solid; border-color: #337ab7;">  
            <div class="panel-body">
<!--                <form id="form-indicador">-->
<form method="post" action="" target="_blank">
                  <div style="overflow: auto; height:300px; width: 100%; border: 1px solid; border-color: #337ab7; margin-bottom: 5px;">
                      <!--class="table table-bordered"  -->                                                 
                    
                        <div id="listaIndicadores">
                                
                        </div>                            
                  </div>
    
    <div>
                    <center>
                        <b>Periodo (día/mes/año)</b>
                    </center>

                    <div class="row">
                        
                        <div class="col-md-12">
                        <table class="table table-condensed">
                            <tr>
                                <td>Fecha Inicial:</td>
                                <td>
                                    <select name="fi_dia" id="fi_dia">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>
                                        <option>31</option>                                        
                                    </select>
                                    
                                </td>
                                <td>
                                    <select name="fi_mes" id="fi_mes">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>                                                                            
                                    </select>
                                    
                                </td>
                                <td>
                                    <select name="fi_anio" id="fi_anio">
                                        <option>2001</option>
                                        <option>2002</option>
                                        <option>2003</option>
                                        <option>2004</option>
                                        <option>2005</option>
                                        <option>2006</option>
                                        <option>2007</option>
                                        <option>2008</option>
                                        <option>2009</option>
                                        <option>2010</option>
                                        <option>2011</option>
                                        <option>2012</option>
                                        <option>2013</option>
                                        <option>2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>                                                                             
                                    </select>
                                    
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Fecha Final:</td>
                                <td>
                                    <select name="ff_dia" id="ff_dia">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>
                                        <option>31</option>                                        
                                    </select>
                                </td>
                                <td>
                                    <select name="ff_mes" id="ff_mes">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>                                                                            
                                    </select>
                                </td>
                                <td>
                                    <select name="ff_anio" id="ff_anio">
                                        <option>2001</option>
                                        <option>2002</option>
                                        <option>2003</option>
                                        <option>2004</option>
                                        <option>2005</option>
                                        <option>2006</option>
                                        <option>2007</option>
                                        <option>2008</option>
                                        <option>2009</option>
                                        <option>2010</option>
                                        <option>2011</option>
                                        <option>2012</option>
                                        <option>2013</option>
                                        <option>2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>                                                                             
                                    </select>
                                </td>
                            </tr>
                        </table>                        
                            </div>
                    </div>
            </div>
                  <center>
                      <b>Ver Tabla</b>
                      <br>
<!--                      <button type="button" id="btnTabla" class="btn btn-default">Tabla</button>-->
<!--                    <input type="submit" value="enviar datos">-->
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="submit" class="btn btn-primary" dir="<?php echo base_url('indicador/tablareg')?>">Regional</button>
                        <button type="submit" class="btn btn-info" dir="<?php echo base_url('indicador/tablapro')?>">Provincial</button>                    
                    </div>
                  </center>
                </form>
            
            </div>
        </div>
    
    </div>

</div>


<!--<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Item #1
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
          <div id="listaIndicadores">
              
          </div>
      </div>
    </div>
  </div>
</div>-->




<script type="text/javascript">
    $(document).ready(function(){
    $("button[type=submit]").click(function() {
        var accion = $(this).attr('dir');
        $('form').attr('action', accion);
        $('form').submit();
    });    
});
</script>   

<script type="text/javascript">
    $(document).ready(function() {
        $("#provincia").change(function() {
            $("#provincia option:selected").each(function() {
					provincia = $('#provincia').val();
					$.post("http://localhost:8080/indicadores/indicador/cargarDistritos", {
						provincia : provincia
					}, function(data) {
						$("#distrito").html(data);
					});
				});
			})
       
                        
		});
</script>



<!--INICIO PRUEBA PARA POST ACTIVANDO CHECK-->
<!--<input type="checkbox" id="provincia" name="provincia" value="281" onclick="changeValueCheckbox(this)" >abancay-->
<script type="text/javascript">
   /* function changeValueCheckbox(element){
        if(element.checked){
            provincia = element.value;
            $.post("http://localhost:8080/indicadores/indicador/cargarDistritos", {
                provincia : provincia
            }, function(data) {
                $("#distrito").html(data);
            });
       }else{
         $("#distrito").html('');
       }
     }*/
</script>
<!--FIN PRUEBA PARA POST ACTIVANDO CHECK-->

<script src="<?php echo base_url('public/js/collapse.js')?>" type="text/javascript"></script>