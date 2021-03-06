<?php
    require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start()   ;
    class PDF extends FPDF{   
        var $widths;
        var $aligns;       
        function SetWidths($w){            
            $this->widths=$w;
        }                       
        function Header(){                         
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,50,210,50);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(90, 5, utf8_decode($_GET['inicio']),0,0, 'R',0);                                                                                        
            $this->Cell(40, 5, utf8_decode($_GET['fin']),0,1, 'C',0);                                                                                                    
            $this->Cell(190, 5, utf8_decode("RESUMEN DE FACTURAS VENTAS"),0,1, 'C',0);                                                                                                                            
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(3);
            $this->SetFillColor(255,255,225);            
            $this->SetLineWidth(0.2);                                        
        }
        function Footer(){            
            $this->SetY(-15);            
            $this->SetFont('Arial','I',8);            
            $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
        }               
    }
    $pdf = new PDF('P','mm','a4');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular');                    
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->SetFont('Arial','B',9);   
    $pdf->SetX(5);    
    $pdf->SetFont('Amble-Regular','',9); 
    $total=0;
    $sub=0;
    $desc=0;
    $ivaT=0;
    $t0 = 0;
    $pdf->SetX(1); 
    $pdf->Cell(22, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('Fecha'),1,0, 'C',0);                                     
    $pdf->Cell(30, 6, utf8_decode('Nro Factura'),1,0, 'C',0);                                     
    $pdf->Cell(15, 6, utf8_decode('Subtotal'),1,0, 'C',0);                                     
    $pdf->Cell(17, 6, utf8_decode('Descuento'),1,0, 'C',0);                                     
    $pdf->Cell(16, 6, utf8_decode('Tarifa 0%'),1,0, 'C',0);                                     
    $pdf->Cell(17, 6, utf8_decode('Tarifa 12%'),1,0, 'C',0);                                     
    $pdf->Cell(15, 6, utf8_decode('Iva 12%'),1,0, 'C',0);                                     
    $pdf->Cell(15, 6, utf8_decode('Total'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('Fecha Pago'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('Tipo Pago'),1,1, 'C',0);                                                                  
    $consulta=pg_query('select * from clientes order by id_cliente asc');
    while($row=pg_fetch_row($consulta)){        
        $consulta1=pg_query("select num_factura,fecha_actual,hora_actual,fecha_cancelacion,tipo_precio,forma_pago,tarifa0,tarifa12,iva_venta,descuento_venta,total_venta,identificacion,nombres_cli,nombre_empresa,id_factura_venta from factura_venta, clientes,empresa,usuario where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_empresa=empresa.id_empresa and usuario.id_usuario=factura_venta.id_usuario and factura_venta.id_cliente='$row[0]' and fecha_actual between '$_GET[inicio]' and '$_GET[fin]' order by factura_venta.id_factura_venta asc");                        
        while($row1=pg_fetch_row($consulta1)){                                     
            $pdf->SetX(1); 
            $pdf->Cell(22, 6, utf8_decode($row1[14]),0,0, 'C',0);                                     
            $pdf->Cell(20, 6, utf8_decode($row1[1]),0,0, 'C',0);                    
            $pdf->Cell(30, 6, utf8_decode(substr($row1[0],8)),0,0, 'C',0);                                
            $sub=$sub+($row1[10]-$row1[8]-$row1[9]);
            $pdf->Cell(15, 6, ($row1[10]-$row1[8]-$row1[9]),0,0, 'C',0);                                    
            $desc=$desc+$row1[9];
            $pdf->Cell(17, 6, $row1[9],0,0, 'C',0);                    
            $pdf->Cell(16, 6, $row1[6],0,0, 'C',0);                    
            $pdf->Cell(17, 6, $row1[7],0,0, 'C',0);                                                    
            $ivaT=$ivaT+$row1[8];
            $pdf->Cell(15, 6, $row1[8],0,0, 'C',0);                                    
            $total=$total+$row1[10];
            $t0 = $row1[6];
            $pdf->Cell(15, 6, $row1[10],0,0, 'C',0);                    
            $pdf->Cell(20, 6, $row1[3],0,0, 'C',0);                    
            $pdf->Cell(20, 6, $row1[5],0,0, 'C',0);                         
            $pdf->Ln(6);                            
        }                       
    }                   
    $pdf->SetX(1);                                             
    $pdf->Cell(207, 0, utf8_decode(""),1,1, 'R',0);
    $pdf->Cell(73, 6, utf8_decode("Totales"),0,0, 'R',0);
    $pdf->Cell(15, 6, maxCaracter((number_format($sub,2,',','.')),20),0,0, 'C',0);                                    
    $pdf->Cell(17, 6, maxCaracter((number_format($desc,2,',','.')),20),0,0, 'C',0);                                    
    $pdf->Cell(17, 6, maxCaracter((number_format($t0,2,',','.')),20),0,0, 'C',0);                                    
    $pdf->Cell(16, 6, maxCaracter((number_format($sub,2,',','.')),20),0,0, 'C',0);                        
    $pdf->Cell(16, 6, maxCaracter((number_format($ivaT,2,',','.')),20),0,0, 'C',0);                        
    $pdf->Cell(14, 6, maxCaracter((number_format($total,2,',','.')),20),0,0, 'C',0);                        
    $pdf->Ln(8);           
    $pdf->Output();
?>
<?php
require('../dompdf/dompdf_config.inc.php');
session_start();
	$codigo='<html> 
    <head> 
   		<link rel="stylesheet" href="../../css/estilosAgrupados.css" type="text/css" /> 
	</head> 
	<body>
		<header>
            <img src="../../images/logo_empresa.jpg" />
            <div id="me">
                <h2 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['empresa'].'</h2>
                <h4 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['slogan'].'</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['propietario'].'</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">'.$_SESSION['direccion'].'</h4>
                <h4 style="text-align:center;border:solid 0px;width:100%;">Telf: '.$_SESSION['telefono'].' Cel:  '.$_SESSION['celular'].' '.$_SESSION['pais_ciudad'].'</h4>
                <h4 style="text-align: center;width:50%;display: inline-block;">Desde el : '.$_GET['inicio'].'</h4>
                <h4 style="text-align: center;width:45%;display: inline-block;">Hasta el : '.$_GET['fin'].'</h4>
        
            </div>      
        </header>        
        <hr>
        <div id="linea">
            <h3>RESUMEN DE FACTURAS VENTAS </h3>
        </div>';
		include '../../procesos/base.php';
		conectarse();    
        $total=0;
        $sub=0;
        $desc=0;
        $ivaT=0;
         $repetido=0;
        $consulta=pg_query('select * from clientes order by id_cliente asc');
        while($row=pg_fetch_row($consulta)){
            $consulta1=pg_query("select num_factura,fecha_actual,hora_actual,fecha_cancelacion,tipo_precio,forma_pago,tarifa0,tarifa12,iva_venta,descuento_venta,total_venta,identificacion,nombres_cli,nombre_empresa,id_factura_venta from factura_venta, clientes,empresa,usuario where factura_venta.id_cliente=clientes.id_cliente and factura_venta.id_empresa=empresa.id_empresa and usuario.id_usuario=factura_venta.id_usuario and factura_venta.id_cliente='$row[0]' and fecha_actual between '$_GET[inicio]' and '$_GET[fin]' order by factura_venta.id_factura_venta asc");
            $contador=pg_num_rows($consulta1);
            if($contador > 0){
               
                while($row1=pg_fetch_row($consulta1)){                     
                    $codigo.='<div id="cuerpo">';
                    if($repetido==0){                        
                        
                        $codigo.='<table>';                      
                        $codigo.='<tr>                
                        <td style="width:70px">Comprobante</td>
                        <td style="width:60px">Fecha</td>
                        <td style="width:70px">Nro Factura</td>
                        <td style="width:60px">Subtotal</td>
                        <td style="width:60px">Descuento</td>                       
                        <td style="width:70px">Tarifa 0%</td>
                        <td style="width:70px">Tarifa 12%</td>
                         <td style="width:60px">Iva 12%</td>
                        <td style="width:70px">Total</td>
                        <td style="width:70px">Fecha Pago</td>
                        <td style="width:70px">Tipo Pago</td></tr><hr>';
                        $repetido=1;   
                        $codigo.='</table>';                    
                    } 
                    $codigo.='<table>';                               
                        $codigo.='<tr>                
                        <td style="width:70px">'.$row1[14].'</td>
                        <td style="width:60px">'.$row1[1].'</td>
                        <td style="width:70px">'.substr($row1[0],8).'</td>';
                        $sub=$sub+($row1[10]-$row1[8]-$row1[9]);
                        $codigo.='<td style="width:60px">'.($row1[10]-$row1[8]-$row1[9]).'</td>';
                        $desc=$desc+$row1[9];
                        $codigo.='<td style="width:60px">'.$row1[9].'</td>                       
                        <td style="width:70px">'.$row1[6].'</td>
                        <td style="width:70px">'.$row1[7].'</td>';
                        $ivaT=$ivaT+$row1[8];
                        $codigo.='<td style="width:60px">'.$row1[8].'</td>';
                        $total=$total+$row1[10];
                        $codigo.='<td style="width:70px">'.$row1[10].'</td>
                        <td style="width:70px">'.$row1[3].'</td>
                        <td style="width:70px">'.$row1[5].'</td></tr>';                         
                    $codigo.='</table>'; 
                   
                    
                   
                    $codigo.='</div>';
                }
            }            
           
        }
        $codigo.='<hr>';
         $codigo.='<table>';                                                
                $codigo.='<tr>
                <td style="width:200px;text-align:center;font-weight:bold">'."Totales".'</td>
                <td style="width:80px;text-align:center;font-weight:bold">'.(number_format($sub,2,',','.')).'</td>
                <td style="width:200px;font-weight:bold">'.(number_format($desc,2,',','.')).'</td>
                <td style="width:60px;text-align:center;font-weight:bold">'.(number_format($ivaT,2,',','.')).'</td>
                <td style="width:60px;text-align:center;font-weight:bold">'.(number_format($total,2,',','.')).'</td>';
                $codigo.='</tr>';                           
                $codigo.='</table>'; 
       
             
	$codigo.='</body></html>';           				 
    $codigo=utf8_decode($codigo);

    $dompdf= new DOMPDF();
    $dompdf->load_html($codigo);
    ini_set("memory_limit","100M");
    $dompdf->set_paper("A4","portrait");
    $dompdf->render();
    //$dompdf->stream("reporteRegistro.pdf");
    $dompdf->stream('facturasVentas.pdf',array('Attachment'=>0));
?>