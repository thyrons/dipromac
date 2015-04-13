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
            $this->Cell(190, 8, $_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
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
            $this->Cell(190, 5, utf8_decode("UTILIDAD GENERAL DE LAS FACTURAS"),0,1, 'C',0);                                                                                                                            
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
    
    $pdf->SetX(1);                                                
    $pdf->Cell(50, 6, utf8_decode('Nro. Factura'),1,0, 'C',0);                                     
    $pdf->Cell(40, 6, utf8_decode('Tipo Documento'),1,0, 'C',0);                                     
    $pdf->Cell(25, 6, utf8_decode('Total P. Venta'),1,0, 'C',0);                                     
    $pdf->Cell(25, 6, utf8_decode('Total P. Compra'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('Utilidad'),1,0, 'C',0);                                     
    $pdf->Cell(25, 6, utf8_decode('Fecha Pago'),1,0, 'C',0);                                                     
    $pdf->Cell(20, 6, utf8_decode('Tipo Pago'),1,1, 'C',0);                    

    $total=0;
    $sub=0;    
    $contador=0; 
    $pv=0;
    $pc=0;
    $util=0;
    $sql1=pg_query("select * from factura_venta where fecha_actual between '$_GET[inicio]' and '$_GET[fin]' and estado='Activo'");
     while($row1=pg_fetch_row($sql1)){
        $pv=0;
        $pc=0;
        $util=0;
        $sql2=pg_query("select * from detalle_factura_venta,productos where detalle_factura_venta.cod_productos=productos.cod_productos and id_factura_venta='$row1[0]'");
        while($row2=pg_fetch_row($sql2)){
            $pv=$pv+($row2[3]*$row2[4]);
            $pc=$pc+($row2[3]*$row2[15]);
            $util=$util+(($row2[3]*$row2[4])-($row2[3]*$row2[15]));
        }
        $pdf->SetX(1);
        $pdf->Cell(50, 6, maxCaracter($row1[5],30),0,0, 'C',false);                                     
        $pdf->Cell(40, 6, utf8_decode('Factura'),0,0, 'C',false);                                     
        $pdf->Cell(25, 6, utf8_decode($pv),0,0, 'C',false);                                     
        $pdf->Cell(25, 6, utf8_decode($pc),0,0, 'C',false);                                     
        $pdf->Cell(20, 6, utf8_decode($util),0,0, 'C',false);                                     
        $pdf->Cell(25, 6, utf8_decode($row1[6]),0,0, 'C',false);                                     
        $pdf->Cell(20, 6, utf8_decode($row1[10]),0,1, 'C',false);                                                                     
        $total=$total+$util;                        
    }
    $pdf->Ln(2);
    $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',0);                                     
    $pdf->Cell(187, 6, utf8_decode('Total Utilidad'),0,0, 'R',0);                                     
    $pdf->Cell(20, 6,(number_format($total,2,',','.')) ,0,0, 'C',0);                                                                                    
    $pdf->Output();
?>