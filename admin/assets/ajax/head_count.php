<?php @session_start(); ?>
<style> .karla{
  color: black;
  font-size: 16px;
  } </style>
<div class="container karla">
  <div class="row">
    <div class="col-md-12">
      <table border='0' width='50%' align='center' id='tbl_busq_hc'>
      <tr>
          <td colspan="4">&nbsp;</td>      
       </tr>
       
       <tr>
          <td colspan="4" align="center"><h3>CONSULTAR HEAD COUNT</h3></td>      
       </tr>
       
       <tr>
          <td colspan="4" align="right">
             <input type="checkbox" id="chk_todas" onclick="marcar(this,':checkbox')"/>
             Seleccionar todas las Pagadoras/Empresas
          </td>      
       </tr>
   
       <tr>
          <td colspan="4">*Pagadora/Empresa</td>      
       </tr>
        
       <tr>
          <td>&nbsp;</td> 
          <td colspan="3">
               <div id="div_empresa" name="div_empresa" style="width:100%; height: 200px; overflow: scroll;">
               </div>
           </td>          
       </tr>
        
       <tr>
          <td colspan="4">&nbsp;</td>      
       </tr>       
       
        <tr>        
           <td>*Mes Corte</td>
           <td><div id="div_mes" name="div_mes"></div></td>    
           <td>*Año Corte</td>
           <td><div id="div_anio" name="div_anio"></div></td>              
        </tr>
        
     
        
       <tr>
          <td colspan="4">&nbsp;</td>      
       </tr>
        
        
       <tr>
          <td>*Departamento</td>
          <td align="center">
            <input type="radio" name="depto" id="depto1" value="1"/>
             Dirección General
          </td>
          
          <td>
            <input type="radio" name="depto" id="depto2" value="2"/>
             Finanzas
          </td>
                
       </tr>
        
      
        
      <tr>
          <td colspan="4">&nbsp;</td>      
       </tr>  
       
       <tr>
          <td colspan='4' align='center'>
        <input type="button" value="ACEPTAR" onclick="trae_head_count()" class="btn"/>  
        
        <input type="button" value="LIMPIAR" onclick="limpiar_inputs()" class="btn"/>       
          </td>      
       </tr>
       
       <tr>
         <td colspan='4'>&nbsp;</td>
       </tr>   
       
       <tr>
       
         <td colspan="4" align="right">
         
              <form action="excel.php" method="post" target="_blank" id="FormularioExportacion">
           <p>Exportar a Excel  <img src="./assets/ajax/imagenes/export_to_excel.gif" class="botonExcel"/></p>
           <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            </form>
         
         </td>
       
       </tr>
   
   </table>   
   

   
   <div id="div_resultados" name="div_resultados"></div>
   
   <input type="hidden" id="hf_condicion_bdactivas" name="hf_condicion_bdactivas"/>
    </div>
  </div>
</div>

   

   <script>
   function trae_head_count(){

    var mensaje = "";
    var chk_empresas = "";
    $('input[name="chk_empresa"]:checked').each(function() {
      chk_empresas += $(this).val() + ",";
    });
    //eliminamos la última coma.
    chk_empresas = chk_empresas.substring(0, chk_empresas.length-1);
    
  var cbx_mes       = $("#cbx_mes").val().trim();
  var cbx_anio      = $("#cbx_anio").val().trim();
  var depto         = "";
    
    var condicion_bd  = $("#hf_condicion_bdactivas").val().trim();

    if(chk_empresas == "")
       mensaje += "* Favor de seleccionar una(s) Pagadora/Empresa.\n";  
  
    if(cbx_mes == "")
     mensaje += "* Favor de seleccionar un mes de corte.\n";

    if(cbx_anio == "")
     mensaje += "* Favor de seleccionar un año de corte.\n";

    if(!$("input[name='depto']:radio").is(':checked'))
      mensaje += "* Favor de seleccionar un departamento.\n";
    else 
        depto = $('input:radio[name=depto]:checked').val(); 

    if(mensaje != ""){
       alert(mensaje);
       return;
    }
    
    $('#div_resultados').html('<center><img src="./assets/ajax/imagenes/loading.gif"/></center>');
        
  $.ajax({
      url: './assets/ajax/scripts_ajax/rpts_head_count.php',
      type: 'POST',
      async: true,
      data: 'chk_empresas='+chk_empresas+'&cbx_mes='+cbx_mes+'&cbx_anio='+cbx_anio+'&depto='+depto+'&condicion_bd='+condicion_bd,
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
          $('#div_resultados').html('<center>ERROR</center>');         
        }
    });       
}
function cargar_combos(){

  $.ajax({
      url: './assets/ajax/scripts_ajax/crears_combos.php',
      async: true,
            success: function(data){
                
              var respuesta = data.split("@@@"); 
              var empresa    = respuesta[0];
              var condicion  = respuesta[1];
              var mes        = respuesta[2];  
              var anio       = respuesta[3];  
              
            $("#div_empresa").html(empresa);
            $("#hf_condicion_bdactivas").val(condicion);
            $("#div_mes").html(mes);
            $("#div_anio").html(anio);
        },
      error: function(){          
          alert("Error.");       
        }
    });     
  
}
$(document).ready(function(){
  cargar_combos();
  $(".botonExcel").click(function(event){       
      $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel_HC").eq(0).clone()).html());
      $("#FormularioExportacion").submit();
      });
});
</script>