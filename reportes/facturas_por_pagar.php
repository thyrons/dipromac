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
            $this->AddFont('Amble-Regular');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, $_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,38,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(190, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(190, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(190, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,45,210,45);            
            $this->SetFont('Arial','B',12);                                                                            
            $this->Cell(190, 5, utf8_decode("FACTURAS POR PAGAR PROVEEDORES"),0,1, 'C',0);                                                                                                                            
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
    $repetido=0;    
    
    $consulta=pg_query('select * from proveedores order by id_proveedor asc');
    while($row=pg_fetch_row($consulta)){
        $repetido=0;
        $sub=0;
        $contador=0;
        $sql1=pg_query("select * from factura_compra where estado='Activo' and id_proveedor='$row[0]' and forma_pago='Credito' order by forma_pago asc;");
        if(pg_num_rows($sql1)){
            while($row1=pg_fetch_row($sql1)){                   
                if($repetido==0){                        
                    $pdf->SetX(1); 
                    $pdf->SetFillColor(187, 179, 180);            
                    $pdf->Cell(70, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[2]),35),1,0, 'L',1);                                     
                    $pdf->Cell(135, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[3]),50),1,1, 'L',1);                                                             
                    $pdf->Ln(2);   
                    $pdf->SetX(1); 
                    $pdf->Cell(25, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
                    $pdf->Cell(30, 6, utf8_decode('Tipo Documento'),1,0, 'C',0);                                     
                    $pdf->Cell(45, 6, utf8_decode('Nro Factura'),1,0, 'C',0);                                                             
                    $pdf->Cell(25, 6, utf8_decode('Total'),1,0, 'C',0);                                     
                    $pdf->Cell(25, 6, utf8_decode('Valor Pago'),1,0, 'C',0);                                     
                    $pdf->Cell(25, 6, utf8_decode('Saldo'),1,0, 'C',0);                                     
                    $pdf->Cell(30, 6, utf8_decode('Fecha Pago'),1,1, 'C',0);                                                                                                                                    
                    $repetido=1;
                    $contador=1;                    
                }
                $sql2=pg_query("select * from factura_compra,pagos_compra where factura_compra.id_factura_compra= pagos_compra.id_factura_compra and pagos_compra.estado='Activo' and pagos_compra.id_proveedor='$row[0]' and factura_compra.id_factura_compra='$row1[0]'");
                while($row2=pg_fetch_row($sql2)){
                    $pdf->Cell(25, 6, utf8_decode($row2[0]),0,0, 'C',0);                                     
                    $pdf->Cell(30, 6, utf8_decode($row2[10]),0,0, 'C',0);                                     
                    $pdf->Cell(45, 6, substr($row2[11],8,30),0,0, 'C',0);                                         
                    $pdf->Cell(25, 6, utf8_decode($row2[29]),0,0, 'C',0);                                         
                    $pdf->Cell(25, 6, utf8_decode($row2[29] - $row2[30]),0,0, 'C',0);                                     
                    $pdf->Cell(25, 6, utf8_decode($row2[30]),0,0, 'C',0);                                         
                    $pdf->Cell(30, 6, utf8_decode($row2[25]),0,1, 'C',0);
                    $sub=$sub+($row2[29]-$row2[30]);                    
                }
            } 
        }     

        $sql3=pg_query("select * from c_pagarexternas where id_proveedor='$row[0]' and estado='Activo'");
        if(pg_num_rows($sql3)){
            while($row3=pg_fetch_row($sql3)){
                if($repetido==0){          
                    $pdf->SetX(1); 
                    $pdf->SetFillColor(187, 179, 180);            
                    $pdf->Cell(70, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[2]),35),1,0, 'L',1);                                     
                    $pdf->Cell(135, 6, maxCaracter(utf8_decode('NOMBRES:'.$row[3]),50),1,1, 'L',1);                                                             
                    $pdf->Ln(2);   
                    $pdf->SetX(1); 
                    $pdf->Cell(25, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
                    $pdf->Cell(30, 6, utf8_decode('Tipo Documento'),1,0, 'C',0);                                     
                    $pdf->Cell(45, 6, utf8_decode('Nro Factura'),1,0, 'C',0);                                                             
                    $pdf->Cell(25, 6, utf8_decode('Total'),1,0, 'C',0);                                     
                    $pdf->Cell(25, 6, utf8_decode('Valor Pago'),1,0, 'C',0);                                     
                    $pdf->Cell(25, 6, utf8_decode('Saldo'),1,0, 'C',0);                                     
                    $pdf->Cell(30, 6, utf8_decode('Fecha Pago'),1,1, 'C',0);                                                                                                                                    
                    $repetido=1;
                    $contador=1;
                }
                $pdf->Cell(25, 6, utf8_decode($row3[4]),0,0, 'C',0);                                     
                $pdf->Cell(30, 6, utf8_decode($row3[8]),0,0, 'C',0);                                     
                $pdf->Cell(45, 6, substr($row3[7],8,30),0,0, 'C',0);                                         
                $pdf->Cell(25, 6, utf8_decode($row3[9]),0,0, 'C',0);                                         
                $pdf->Cell(25, 6, utf8_decode($row3[9] - $row3[10]),0,0, 'C',0);                                     
                $pdf->Cell(25, 6, utf8_decode($row3[10]),0,0, 'C',0);                                         
                $pdf->Cell(30, 6, utf8_decode($row3[5]),0,1, 'C',0);
                $sub=$sub+($row3[9]-$row3[10]);
            }
        }
        if($contador>0){
            $pdf->SetX(1);                                             
            $pdf->Cell(207, 0, utf8_decode(""),1,1, 'R',0);
            $pdf->Cell(180, 6, utf8_decode("Totales"),0,0, 'R',0);
            $pdf->Cell(30, 6, maxCaracter((number_format($sub,2,',','.')),20),0,1, 'C',0);                                                    
            $pdf->Ln(3);                                               
        }
    }  
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
            </div>            
    </header>        
    <hr>
    <div id="linea">
        <h3>FACTURAS POR PAGAR POR PROVEEDORES </h3>
    </div>';
    include '../../procesos/base.php';
    conectarse();    
    $total=0;
    $sub=0;
    $desc=0;
    $ivaT=0;
    $repetido=0;    
    
    $consulta=pg_query('select * from proveedores order by id_proveedor asc');
    while($row=pg_fetch_row($consulta)){
        $repetido=0;
        $sub=0;
        $contador=0;
        $sql1=pg_query("select * from factura_compra where estado='Activo' and id_proveedor='$row[0]' and forma_pago='Credito' order by forma_pago asc;");
        if(pg_num_rows($sql1)){
            while($row1=pg_fetch_row($sql1)){                   
                if($repetido==0){                        
                    $codigo.='<h2 style="color:#1B8D72;font-weight: bold;font-size:13px;">RUC/CI: '.$row[2].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[3].'</h2>';
                    $codigo.='<table>'; 
                    $codigo.='<tr>                
                        <td style="width:100px;text-align:center;">Comprobante</td>    
                        <td style="width:100px;text-align:center;">Tipo Documento</td>
                        <td style="width:150px;text-align:center;">Nro Factura</td>    
                        <td style="width:100px;text-align:center;">Total</td>
                        <td style="width:100px;text-align:center;">Valor Pago</td>
                        <td style="width:100px;text-align:center;">Saldo</td>
                        <td style="width:100px;text-align:center;">Fecha Pago</td></tr><hr>';
                    $repetido=1;   
                    $repetido=1;
                    $contador=1;
                    $codigo.='</table>'; 
                }               

                $sql2=pg_query("select * from factura_compra,pagos_compra where factura_compra.id_factura_compra= pagos_compra.id_factura_compra and pagos_compra.estado='Activo' and pagos_compra.id_proveedor='$row[0]' and factura_compra.id_factura_compra='$row1[0]'");
                while($row2=pg_fetch_row($sql2)){
                    $codigo.='<table>'; 
                    $codigo.='<tr>                
                    <td style="width:100px;text-align:center;">'.$row2[0].'</td>    
                    <td style="width:100px;text-align:center;">'.$row2[10].'</td>
                    <td style="width:150px;text-align:center;">'.substr($row2[11],8,30).'</td>    
                    <td style="width:100px;text-align:center;">'.$row2[29].'</td>
                    <td style="width:100px;text-align:center;">'.($row2[29]-$row2[30]).'</td>
                    <td style="width:100px;text-align:center;">'.$row2[30].'</td>
                    <td style="width:100px;text-align:center;">'.$row2[25].'</td></tr>';
                    $sub=$sub+($row2[29]-$row2[30]);
                    $codigo.='</table>'; 
                }        
            } 
        }        

        $sql3=pg_query("select * from c_pagarexternas where id_proveedor='$row[0]' and estado='Activo'");
        if(pg_num_rows($sql3)){
            while($row3=pg_fetch_row($sql3)){
                if($repetido==0){                        
                    $codigo.='<h2 style="color:#1B8D72;font-weight: bold;font-size:13px;">RUC/CI: '.$row[2].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[3].'</h2>';
                    $codigo.='<table>'; 
                    $codigo.='<tr>                
                    <td style="width:100px;text-align:center;">Comprobante</td>    
                    <td style="width:100px;text-align:center;">Tipo Documento</td>
                    <td style="width:150px;text-align:center;">Nro Factura</td>    
                    <td style="width:100px;text-align:center;">Total</td>
                    <td style="width:100px;text-align:center;">Valor Pago</td>
                    <td style="width:100px;text-align:center;">Saldo</td>
                    <td style="width:100px;text-align:center;">Fecha Pago</td></tr><hr>';
                    $repetido=1;   
                    $repetido=1;
                    $contador=1;
                    $codigo.='</table>'; 
                }
                $codigo.='<table>'; 
                $codigo.='<tr>                
                <td style="width:100px;text-align:center;">'.$row3[4].'</td>    
                <td style="width:100px;text-align:center;">'.$row3[8].'</td>
                <td style="width:150px;text-align:center;">'.substr($row3[7],8,30).'</td>    
                <td style="width:100px;text-align:center;">'.$row3[9].'</td>
                <td style="width:100px;text-align:center;">'.($row3[9]-$row3[10]).'</td>
                <td style="width:100px;text-align:center;">'.$row3[10].'</td>
                <td style="width:100px;text-align:center;">'.$row3[5].'</td></tr>';
                $sub=$sub+($row3[9]-$row3[10]);
                $codigo.='</table>'; 

            }
        }
        if($contador>0){
                $codigo.='<hr>';
                $codigo.='<table>';                                                
                $codigo.='<tr>
                <td style="width:200px;text-align:center;font-weight:bold">'."Totales".'</td>
                <td style="width:800px;text-align:center;font-weight:bold">'.(number_format($sub,2,',','.')).'</td>';
                $codigo.='</tr>';                           
                $codigo.='</table>'; 
                $codigo.='<br/>';
            }
        

    }
               
    $codigo.='</body></html>';                           
    $codigo=utf8_decode($codigo);

    $dompdf= new DOMPDF();
    $dompdf->load_html($codigo);
    ini_set("memory_limit","1000M");
    $dompdf->set_paper("A4","portrait");
    $dompdf->render();
    //$dompdf->stream("reporteRegistro.pdf");
    $dompdf->stream('facturas_por_pagar.pdf',array('Attachment'=>0));
?>