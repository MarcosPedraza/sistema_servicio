<?php 

require_once '/vendor/mpdf/mpdf/mpdf.php';
require 'php/conexion.php';



global $mysqli;

//consulta de prueba

$data_reportes = mysqli_query($mysqli, "SELECT * FROM reportea");



$html_gen = ""; //esta es la variable que va a guardar las filas que se van generando abajo

//$row = mysql_fetch_row($data_reportes);

//$message = var_dump($data_reportes);

//recorro los datos de la consulta


while($row =mysqli_fetch_array($data_reportes)) 
{
	//tengo que poner cada dato en una variable por que no me deja sacarlo directamente
	$campo1 = $row['campo1'];
	$campo2 = $row['campo2'];
	$campo3 = $row['campo3'];
	$campo4 = $row['campo4'];
	$campo5 = $row['fechaRegistro'];


	//a la variable de html_gen le voy concatenando los datos de la siguiente fila es: lo que ya tiene + lo que le sigue
	$html_gen = $html_gen . "
							<tr>
							<td width=122 valign=top style='padding: 5px; width:132.5pt; border:solid; border-width: 0.5px' > $campo1 </td>
							<td width=122 valign=top style='padding: 5px; width:132.5pt; border:solid; border-width: 0.5px' > $campo2 </td>
							<td width=122 valign=top style='padding: 5px; width:132.5pt; border:solid; border-width: 0.5px' > $campo3 </td>
							<td width=122 valign=top style='padding: 5px; width:132.5pt; border:solid; border-width: 0.5px' > $campo4 </td>
							<td width=122 valign=top style='padding: 5px; width:132.5pt; border:solid; border-width: 0.5px' > $campo5 </td>
							</tr>
	";
	
} 

//$encargado = mysqli_fetch_array()

//$html_gen = mb_convert_encoding($html_gen, 'UTF-8', 'UTF-8');

//mb_convert_encoding($html_gen, 'UTF-8','utf8_spanish_ci');





$mpdf = new Mpdf();
$mpdf->allow_charset_conversion=true; 
$mpdf->ignore_invalid_utf8 = true;
$mpdf->charset_in='UTF-8';
$mpdf->AddPage('L');
$mpdf->WriteHTML('<html>');
$mpdf->WriteHTML('<head>');
$mpdf->WriteHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>');
$mpdf->WriteHTML('</head>');
$mpdf->WriteHTML('<body>');

//$mpdf->WriteHTML($message);
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
  normal'>UNIDAD ENCARGADA:</p>
  </td>
 </tr>

");


$mpdf->WriteHTML('</table>');

$mpdf->WriteHTML("<p class=MsoNormal>&nbsp;</p>


<!-----------------------------         tabla principal ----------------------------------------------------------------------   -->

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 align='center'
 style='width:600.9pt;border-collapse:collapse;border:solid;
 margin-left:5.25pt;margin-right:5.25pt'>
  <tr style='height:44.1pt'>
  <td width=196 valign=top 
  style='width:117.65pt;
  border:solid 1.0pt;
  background:#D0CECE;
  padding:0cm 5.4pt 0cm 5.4pt;height:44.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt;
  font-family:'Arial',sans-serif'>REFERENCIA DE LA UBICACIÓN DEL EXPEDIENTE  O
  ARCHIVO MAGNÉTICO(4)</span></p>
  </td>
  <td width=208 valign=top style='width:124.8pt;border:solid 1.0pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:44.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt;
  font-family:'Arial',sans-serif'>CLASIFICACIÓN, NUMERO DE CONTROL DEL
  EXPEDIENTE  O NOMBRE DEL ARCHIVO MAGNÉTICO(5)</span></p>
  </td>
  <td width=453 valign=top style='width:271.6pt;border:solid 1.0pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:44.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt;
  font-family:'Arial',sans-serif'>DESCRIPCIÓN DEL EXPEDIENTE O ARCHIVO
  MAGNÉTICO.</span></p>
  </td>
  <td width=122 valign=top style='width:73.35pt;border:solid;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:44.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt;
  font-family:'Arial',sans-serif'>TOMOS</span></p>
  </td>
  <td width=119 valign=top style='width:71.5pt;border:solid 0.5pt;
  border-left:none;background:#D0CECE;padding:0cm 5.4pt 0cm 5.4pt;height:44.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:9.0pt;
  font-family:'Arial',sans-serif'>PERIODO COMPRENDIDO O FECHA DE ELABORACIÓN</span></p>
  </td>
 </tr>

");

/*
$mpdf->WriteHTML("<!-- ------------------------------------ datos de prueba --------------------------------------------    -->
<tr>
	<td width=122 valign=top style='border:solid; border-width: 0.5px' >  </td>
	<td width=122 valign=top style='border:solid; border-width: 0.5px' >Dato 2</td>
	<td width=122 valign=top style='border:solid; border-width: 0.5px' >Dato 3</td>
	<td width=122 valign=top style='border:solid; border-width: 0.5px' >Dato 4</td>
	<td width=122 valign=top style='border:solid; border-width: 0.5px' >Dato 5</td>
</tr>

");

*/


$mpdf->WriteHTML($html_gen); // aca le inserto el html generado al cuerpo del documento ------------------------------------


$mpdf->WriteHTML('</table>');


$mpdf->WriteHTML("

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal><u><span style='text-decoration:none'>&nbsp;</span></u></p>

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
  text-align:center;line-height:normal'>prueba</p>
  </td>
 </tr>
</table>
<p class=MsoNormal>&nbsp;</p>
<p class=MsoNormal>&nbsp;</p>
</div>
");
$mpdf->WriteHTML('</body>');

$mpdf->WriteHTML('</html>');
$mpdf->Output();
 ?>