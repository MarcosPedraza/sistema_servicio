<?php
require_once '/vendor/mpdf/mpdf/mpdf.php';

require 'php/conexion.php';

global $mysqli;

//mi consulta de prueba con un id de prueba

$data_reportes = mysqli_query($mysqli, "SELECT * FROM reporteb where id_usuario='41'");

$dato = mysqli_num_rows($data_reportes);


//$nombre_encargado = "dato de prueba";

$html_gen = "";



while($row = mysqli_fetch_array($data_reportes)) 
{
	//tengo que poner cada dato en una variable por que no me deja sacarlo directamente
	$prioridad = $row['prioridad'];
	$asunto = $row['asunto'];
	$fecha_atencion = $row['fechaAtencion'];
	$unidad_adm = $row['unidadAd'];
	$campo5 = $row['fechaRegistro'];

//a la variable de html_gen le voy concatenando los datos de la siguiente fila es: lo que ya tiene + lo que le sigue
//hay que checar que prioridad tiene para saber si poner una letra X a una columna o a la otra	
if($prioridad == 'alta'){

	$html_gen = $html_gen . "
							<tr style='height:51.8pt'>
  <td width=221 valign=top style='padding: 5px; width:132.5pt;border:solid; border-width: 0.5px'> $asunto </td>
  <td width=86 valign=top style='vertical-align:middle; text-align: center; width:51.55pt;border:solid; border-width: 0.5px'> X </td>
  <td width=83 valign=top style='width:49.6pt;border:solid; border-width: 0.5px'> </td>
  <td width=260 valign=top style='width:155.95pt;border:solid; border-width: 0.5px'> dato 3</td>
  <td width=234 valign=top style='width:140.4pt;border:solid; border-width: 0.5px'> dato 4 </td>
  <td width=221 valign=top style='width:132.5pt;border:solid; border-width: 0.5px'> dato 5 </td>
 </tr>
	";

}

if ($prioridad == 'baja') {

$html_gen = $html_gen . "
							<tr style='height:51.8pt'>
  <td width=221 valign=top style='padding: 5px; width:132.5pt;border:solid; border-width: 0.5px' > $asunto </td>
  <td width=86 valign=top style='width:51.55pt;border:solid; border-width: 0.5px'>  </td>
  <td width=83 valign=top style='vertical-align:middle; text-align: center; width:51.55pt;border:solid; border-width: 0.5px'> X </td>
  <td width=260 valign=top style='padding: 5px; width:132.5pt; width:155.95pt;border:solid; border-width: 0.5px'> dato 3</td>
  <td width=234 valign=top style='padding: 5px; width:132.5pt; width:140.4pt;border:solid; border-width: 0.5px'> dato 4 </td>
  <td width=221 valign=top style='padding: 5px; width:132.5pt;width:132.5pt;border:solid; border-width: 0.5px'> dato 5 </td>
 </tr>
	";

}



	
} 

$mpdf = new Mpdf();
$mpdf->AddPage('L');
$mpdf->WriteHTML('<html>');
$mpdf->WriteHTML('<head>');
$mpdf->WriteHTML('</head>');
$mpdf->WriteHTML('<body>');

$mpdf->WriteHTML("<div class=WordSection1>

<table align='center' class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width=1104
 style='width:662.45pt;border-style=solid;border-collapse:collapse;border:none'>
 <tr style='height:65.4pt'>
  <td width=276 valign=top style='width:165.6pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  padding:0cm 5.4pt 0cm 5.4pt;height:65.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><img width=164 height=107
  src='images/cndh.jpg' align=left hspace=12
  alt='icon_CDH'></p>
  </td>
  <td align='center' width=552 style='width:331.25pt;border:none;border-top:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:65.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;
  line-height:normal'>COMISIÓN DE DERECHOS HUMANOS DEL ESTADO
  DE HIDALGO</p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>&nbsp;</p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>DOCUMENTACIÓN Y ARCHIVOS, IMPRESOS Y
  ELECTRÓNICOS</p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>&nbsp;</p>
  </td>
  <td width=276 align='center' valign=top style='width:165.6pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:65.4pt'>
  <p class=MsoNormal style='text-align:center; margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><img width=99 height=116 src='images/Estado_de_Hidalgo.png'
  align=center hspace=12 alt='Estado_de_Hidalgo'></p>
  </td>
 </tr>
 <tr style='height:22.45pt'>
  <td width=276 rowspan=2 valign=top style='width:165.6pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;padding:0cm 5.4pt 0cm 5.4pt;height:22.45pt'>
  <p class=MsoNormal style='text-align center;margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>&nbsp;</p>
  </td>
  <td width=552 valign=top style='width:331.25pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.45pt'>
  <p class=MsoNormal style='font-size: 8.0pt;margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>INSTITUCIÓN: COMISIÓN DE DERECHOS HUMANOS DEL ESTADO
  DE HIDALGO</p>
  </td>
  <td width=276 rowspan=2 valign=top style='width:165.6pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>&nbsp;</p>
  </td>
 </tr>

 <!-- ------------------------------------ unidad encargada --------------------------------------------    -->
 <tr style='height:23.45pt'>
  <td width=552 valign=top style='width:331.25pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:23.45pt'>
  <p class=MsoNormal style='font-size: 8.0pt; margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>UNIDAD ENCARGADA: $nombre_encargado</p>
  </td>
 </tr>
</table>

 <!-- ------------------------------------ acaba header --------------------------------------------    -->


<p class=MsoNormal>&nbsp;</p>

<!---------------------------------------------tabla de contenido principal ------------------------------------------------------------------------- -->

<table align='center' class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width=1104
 style='width:662.5pt;border-collapse:collapse;border-style:solid'>
 <tr style='height:22.95pt'>
  <td width=221 rowspan=2 style='width:132.5pt;border:solid 1.0pt;
  background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:22.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt'>ASUNTO</span></p>
  </td>
  <td width=169 colspan=2 style='width:101.15pt;border:solid 1.0pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:22.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt'>PRIORIDAD</span></p>
  </td>
  <td width=260 rowspan=2 style='width:155.95pt;border:solid 1.0pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:22.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt'>FECHA
  PARA ATENCIÓN</span></p>
  </td>
  <td width=234 rowspan=2 style='width:140.4pt;border:solid 1.0pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:22.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt'>UNIDAD
  ADMINISTRATIVA</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt'>RESPONSABLE
  DE LA ATENCIÓN</span></p>
  </td>
  <td width=221 rowspan=2 style='width:132.5pt;border:solid 1.0pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:22.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt'>SITUACIÓN
  DEL TRAMITE</span></p>
  </td>
 </tr>
 <tr style='height:2.9pt'>
  <td width=86 valign=top style='width:51.55pt;border-top:none;border-left:
  none;border-bottom:solid 1.0pt;border-right:solid windowtext 1.0pt;
  background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:2.9pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt'>ALTA</span></p>
  </td>
  <td width=83 valign=top style='width:49.6pt;border-bottom:solid 1.0pt;border: solid 1.0pt;
  background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:2.9pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt'>BAJA</span></p>
  </td>
 </tr>

 <!--------------------------datos de prueba ---------------------->


 <!-- 
 
 <tr style='height:51.8pt'>


  <td width=221 valign=top style='width:132.5pt;border:solid; border-width: 0.5px'>
  dato1
  </td>
  <td width=86 valign=top style='width:51.55pt;border:solid; border-width: 0.5px'> X </td>
  <td width=83 valign=top style='width:49.6pt;border:solid; border-width: 0.5px'> </td>
  <td width=260 valign=top style='width:155.95pt;border:solid; border-width: 0.5px'> dato 3</td>
  <td width=234 valign=top style='width:140.4pt;border:solid; border-width: 0.5px'> dato 4 </td>
  <td width=221 valign=top style='width:132.5pt;border:solid; border-width: 0.5px'> dato 5 </td>
 </tr>


 -->

");

$mpdf->WriteHTML($html_gen); // aca le inserto el html generado al cuerpo del documento ------------------------------------

$mpdf->WriteHTML(' </table>
<!--------------------------------------------- fin de la tabla de contenido principal -------------------------------------------------------------------->


');


$mpdf->WriteHTML("

<p class=MsoNormal>&nbsp;</p>
<p class=MsoNormal>&nbsp;</p>


<!-- ---------------------- seccion encargados   --------------------------------------              -->

<table align='center' class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=361 valign=top style='width:216.6pt;border:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='font-size: 9.0pt; margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>RESPONSABLE DE LA INFORMACIÓN</p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>&nbsp;</p>
  </td>
  <td width=361 valign=top style='width:216.6pt;border:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='font-size: 9.0pt; margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>ENCARGADO DE LA ENTREGA</p>
  </td>
  <td width=361 valign=top style='width:216.6pt;border:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='font-size: 9.0pt; margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>ENCARGADO DE LA RECEPCIÓN</p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>&nbsp;</p>
  </td>
 </tr>
 <tr>
  <td width=361 valign=top style='width:216.6pt;border:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>nombre</p>
  </td>
  <td width=361 valign=top style='width:216.6pt;border:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>nombre</p>
  </td>
  <td width=361 valign=top style='width:216.6pt;border:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>nombre</p>
  </td>
 </tr>
</table>


");

$mpdf->WriteHTML('</body>');

$mpdf->WriteHTML('</html>');
$mpdf->Output();

  ?>