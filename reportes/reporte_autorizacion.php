<?php
    require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start()   ;
    class PDF extends FPDF
    {   
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
            $this->Cell(190, 8,$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.5);
            $this->SetFillColor(120,120,120);
            $this->Line(1,45,210,45);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(190, 5, utf8_decode("AUTORIZACIONES ENTREGADAS AL CLIENTE"),0,1, 'C',0);                                                                                                                
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(5);              
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
    $repetido=0;   
    $contador=0; 
    $consulta=pg_query("select id_cliente,identificacion,nombres_cli,telefono,direccion_cli from clientes where id_cliente='$_GET[id]'");
    while($row=pg_fetch_row($consulta)){
        $repetido=0;
        $total=0;
        $sql1=pg_query("select id_factura_venta,num_factura,num_autorizacion,fecha_autorizacion,fecha_caducidad FROM factura_venta where id_cliente='$row[0]' and estado='Activo'");
        if(pg_num_rows($sql1)){
            if($repetido==0){
                $pdf->SetX(1);        
                $pdf->SetFillColor(221,221,221);          
                $pdf->Cell(80, 6, utf8_decode('RUC/CI: '.$row[1]),1,0, 'L',1);                                                                                                        
                $pdf->Cell(125, 6, utf8_decode('NOMBRE: '.$row[2]),1,1, 'L',1);                       
                $pdf->SetX(1);        
                $pdf->Cell(80, 6, utf8_decode('TELF.: '.$row[3]),1,0, 'L',1);                                                                                                        
                $pdf->Cell(125, 6, utf8_decode('DIRECCIÓN:  '.$row[4]),1,1, 'L',1);                       
                $pdf->Ln(2);
                $pdf->SetX(1);        
                $pdf->Cell(40, 6, utf8_decode("Nro Factura"),1,0, 'C',0);
                $pdf->Cell(35, 6, utf8_decode("Tipo Documento"),1,0, 'C',0);
                $pdf->Cell(50, 6, utf8_decode("Nro. Autorización"),1,0, 'C',0);        
                $pdf->Cell(40, 6, utf8_decode("Fecha Autorización"),1,0, 'C',0);                    
                $pdf->Cell(40, 6, utf8_decode("Fecha caducidad"),1,1, 'C',0);                               
                $repetido=1;
            }            
            while($row1=pg_fetch_row($sql1)){                
                $pdf->SetX(1);        
                $pdf->Cell(40, 6, utf8_decode($row1[1]),0,0, 'C',0);                       
                $pdf->Cell(35, 6, utf8_decode('Factura'),0,0, 'C',0);                       
                $pdf->Cell(50, 6, utf8_decode($row1[2]),0,0, 'C',0);                       
                $pdf->Cell(40, 6, utf8_decode($row1[3]),0,0, 'C',0);                       
                $pdf->Cell(40, 6, utf8_decode($row1[4]),0,1, 'C',0);                                       
            }                       
        } 
    }       
    $pdf->Output();
?>
