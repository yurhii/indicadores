<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">                
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url('public/img/favicon.ico')?>" rel="icon" type="image/x-icon" />
        <title>Reporte Indicadores Regional</title>
        
        <link href="<?php echo base_url('public/css/bootstrap.css') ?>" rel="stylesheet" media="screen">        
        <script src="<?php echo base_url('public/js/bootstrap.js') ?>"></script>
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="<?php echo base_url('public/highcharts/js/highcharts.js')?>"></script>
        <script src="<?php echo base_url('public/highcharts/js/modules/exporting.js')?>"></script>
        
        		<script type="text/javascript">
$(function () {
    $('#containeres').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Valor: Indicadores'
        },
        xAxis: {
            categories: [
                '2005',
                '2006',
                '2007',
                '2008',
                '2009',
                '2010',
                '2011',
                '2012',
                '2013',
                '2014',
                '2015'
                
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Valores'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: <?php echo $series_data; ?>
    });
});
		</script>
        
                <script>
                
                $(function () {
    $('#container2').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Valor: Indicadores'
        },
        xAxis: {
            categories: [
                '2005',
                '2006',
                '2007',
                '2008',
                '2009',
                '2010',
                '2011',
                '2012',
                '2013',
                '2014',
                '2015'
                
            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Indicadores 2015',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: <?php echo $series_data; ?>
    });
});
                
                </script>
        
    </head>
    <body style="margin-bottom: 0; padding: 0;">    
        
        
        
    <center>
        <img width="100%" src="<?php echo base_url()?>public/img/siar2015.jpg">
    </center>
    <br>
    <br>
        
        <div class="contenido" id="container">            
            <div class="col-md-12">
               	<?php                
                    if($datostablaReg!='Error'){
                        if(count($datostablaReg)>0){
                            
                ?>
                
                <!--<form method="post" action="<?php //echo base_url('indicador/exportExcel')?>" target="_blank">-->
                    
                <table class="table table-bordered">
                    <?php $anios = array("2005","2006","2007","2008","2009","2010","2011","2012","2013","2014","2015");?>
                    <thead style="background-color: #D9EDF7">
                    <th>Sector</th>
                    <th>Indicador</th>
                    <th>U.Medida</th>
                        <?php
                            foreach ($anios as $value) {
                                echo '<th>'.$value.'</th>';
                            }
                        ?>
                    </thead>
                    <tbody>
                        
                    <?php    
                    $indisec = $this->session->userdata('indisec');
                    $colores = array('#7CB5EC','#434348','#90ED7D','#F7A35C','#8085E9','#F15C80','#E4D354','#2B908F','#F45B5B','#91E8FF');                
                    $cantidad = 0;
                          foreach ($datostablaReg as $valued) {                              
                              foreach ($valued as $value) {
                                  
                              ?>
                    <tr>
                        
                        <?php 
                        
                        for ($i = 0; $i < count($indisec); $i++) {
                            $unionindisec = $indisec[$i][0].' '.$indisec[$i][1];
                            if($unionindisec==$value->nombre){
                                echo '<td>'.$indisec[$i][1].'</td>';
                                echo '<input type="hidden" name="sector[]" value="'.$indisec[$i][1].'">';
                                //echo '<td>'.$indisec[$i][0].' <span class="label label-primary"> '.$indisec[$i][2].' </span></td>';
                                echo '<td>'.$indisec[$i][0].'</td>';
                                echo '<input type="hidden" name="indicador[]" value="'.$indisec[$i][0].'">';
                                
                                echo '<td><center><span style="color:'.$colores[$cantidad].'; font-size: 13px;font-weight: bold;"> '.$indisec[$i][2].' </span></center></td>';
                                echo '<input type="hidden" name="unimedida[]" value="'.$indisec[$i][2].'">';
                            }                        
                        } ?>
                    
                        <td>
                            
                        <center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2005; ?>
                            </span>
                        </center>
                        </td>
                        
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2006; ?>
                                </span></center>
                        </td>
                        <td>
                            <center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2007; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2008; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2009; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2010; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2011; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2012; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2013; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2014; ?>
                                </span></center>
                        </td>
                        <td><center>
                            <span class="label label-default" style="background-color:<?php echo $colores[$cantidad]; ?>; font-size: 13px; ">
                            <?php echo $value->a2015; ?>
                            </span></center>
                        </td>
                        
                    </tr>
                    <?php
                    $cantidad++;
                          }
                        }
                    ?>
                    </tbody>
                </table>
<!--                <input type="submit" class="btn btn-info" value="ver">
                </form>-->

                <div id="containeres" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
                <br>
                <br>
                <hr>
                <br>
                <br>
                <div id="container2" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
                
                <?php
                        }else{
                            echo '<p class="bg-danger"><b>Error</b>: No existen datos, seleccionar sector y indicador.</p>';
                        }
                    }else{
                        echo '<p class="bg-danger"><b>Error</b>: No existen datos, seleccionar sector y indicador.</p>';
                    }
                ?>
            </div>                        
        </div>
    
    
        
        

        
        <footer>
            <center>
                <h4>                   
                    </h4> &copy; Indicadores - 2015
                </center>
        </footer>
    </body>       
</html>





