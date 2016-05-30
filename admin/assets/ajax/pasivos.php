<?php @session_start(); ?>
<style> 
.karla{
  color: black;
  font-size: 16px;
  }
  .jorge{
  padding-left: -140px;
  } 
  </style>
<div class="container karla">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <table border='0' width='50%' align='center'>
   
       <tr>
          <td colspan="2">&nbsp;</td>      
       </tr>
       
        <tr>
          <td colspan="2" align="center"><h3>CONSULTAR PASIVOS DE NOMINA</h3></td>      
       </tr>
       
       <tr>
          <td>* PAGADORA</td>
          <td><div id="div_pagadoras" name="div_pagadoras"></div></td>   
       </tr>       
       
       <tr>
          <td colspan="2">&nbsp;</td>      
       </tr> 
       
       <tr>
          <td>CLIENTE</td> 
          <td><div id="div_clientes" name="div_clientes"></div></td>          
       </tr>
        
       <tr>
          <td colspan="2">&nbsp;</td>      
       </tr>       
       
        <tr>
        
          <td> * Fecha Inicio
               <input type="text" id="txt_fecha1" name="txt_fecha1"/>
          </td>
          
           <td>* Fecha Fin
                <input type="text" id="txt_fecha2" name="txt_fecha2"/>
          </td> 
          
        </tr>  
        
        <tr>
          <td colspan="2">&nbsp;</td>      
       </tr>  
       
       <tr>
          <td colspan='2' align='center'>
        <input type="button" value="ACEPTAR" onclick="trae_reporte()" class="btn"/> 
        
        <input type="button" value="LIMPIAR" onclick="limpiar_inputs()" class="btn"/>       
          </td>      
       </tr>
       
       <tr>
         <td colspan='2'>&nbsp;</td>
       </tr>   
       
       <tr>
       
         <td colspan="2" align="right">
         
              <form action="excel.php" method="post" target="_blank" id="FormularioExportacion">
           <p>Exportar a Excel  <img src="./assets/ajax/imagenes/export_to_excel.gif" class="botonExcel"/></p>
           <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            </form>
         
         </td>
       
       </tr>
   
   </table>
    </div>
  </div>   
</div>
   <div class="container jorge">
     <div id="div_resultados" name="div_resultados"></div>
   </div>


<script>
function cargar_combos(){
  $.ajax({
      url: './assets/ajax/scripts_ajax/crear_combos.php',
      type: 'POST',
      async: true,
      data: 'txt_fecha1='+txt_fecha1+'&txt_fecha2='+txt_fecha2,
            success: function(data){      

              var respuesta = data.split("@@@");
                        
             $("#div_pagadoras").html(respuesta[0]);
             $("#div_clientes").html(respuesta[1]);       
        },
      error: function(){          
          alert("Error.");       
        }
    });     
  }
function trae_reporte(){

    var mensaje = "";
  var cbx_pagadoras = $("#cbx_pagadoras").val().trim();
  var cbx_clientes  = $("#cbx_clientes").val().trim();

  //Leer rango de fechas  
  var txt_fecha1    = $("#txt_fecha1").val().trim();
  var txt_fecha2    = $("#txt_fecha2").val().trim();

  if(cbx_pagadoras == "")
     mensaje += "* Favor de seleccionar una Pagadora\n";

  if(txt_fecha1 == "" || txt_fecha2 == "")
     mensaje += "* Favor de seleccionar un rango de fechas\n";  

    if(mensaje != ""){
       alert(mensaje);
       return;
    }


//alert("CBX PAGADORAS: " + cbx_pagadoras);
    
    
    //Añadimos la imagen de carga en el contenedor
    $('#div_resultados').html('<center><img src="./assets/ajax/imagenes/loading.gif"/></center>');
        
  $.ajax({
      url: './assets/ajax/scripts_ajax/rpt_compac.php',
      type: 'POST',
      async: true,
      data: 'cbx_pagadoras='+cbx_pagadoras+'&cbx_clientes='+cbx_clientes+'&txt_fecha1='+txt_fecha1+'&txt_fecha2='+txt_fecha2,
            success: function(data){


              //alert(data);
              //return;
              
              
                var respuesta = data.split("@@@");
                var exito     = respuesta[0];
                var salida    = respuesta[1];
         
                    if(exito == 0){
                    alert(salida);
                      $('#div_resultados').html('<center>' + salida + '</center>');    
                    } 
              
                    if(exito == 1)    
                      $("#div_resultados").fadeIn(1000).html(salida);
                    
                                      
        },
      error: function(){          
          alert("Error.");       
        }
    });       
}
$(document).ready(function(){
  cargar_combos();
  $("#txt_fecha1").datepicker();
  $("#txt_fecha2").datepicker();
  $(".botonExcel").click(function(event){       
      $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
      $("#FormularioExportacion").submit();
      });
});
</script>