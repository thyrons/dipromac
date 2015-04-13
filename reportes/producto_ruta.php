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
            $this->Cell(170, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,45,30);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.3);

            $this->SetFillColor(120,120,120);            
            $this->Line(1,50,210,50);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(190, 5, utf8_decode("PRODUCTO MAS VENDIDO POR RUTA"),0,1, 'C',0);                                          
            $this->SetFont('Amble-Regular','',10);                                                                             
            $this->Cell(120, 5, utf8_decode("DESDE: ".$_GET['inicio']),0,0, 'C',0);
            $this->Cell(60, 5, utf8_decode("HASTA: ".$_GET['fin']),0,1, 'C',0);         
            
            $this->Ln(2);
            $this->SetFillColor(255,255,225);
            
            $this->SetX(1);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(40, 5, utf8_decode("CÓDIGO"),1,0, 'C',0);
            $this->Cell(75, 5, utf8_decode("PRODUCTO"),1,0, 'C',0);            
            $this->Cell(40, 5, utf8_decode("SECTOR"),1,0, 'C',0);                
            $this->Cell(25, 5, utf8_decode("CANTIDAD"),1,0, 'C',0);                            
            $this->Cell(25, 5, utf8_decode("TOTAL"),1,1, 'C',0);                            
            $this->Ln(1);        
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
    $total = 0;      
    if($_GET['val'] == 'Todas'){    
       $sql=pg_query("select productos.cod_productos,codigo,articulo, sum(cantidad::int) as cantidad, sum(detalle_factura_venta.total_venta::float),nombre_ruta from factura_venta, detalle_factura_venta,productos,clientes,cliente_sector,sectores,rutas where detalle_factura_venta.cod_productos = productos.cod_productos and factura_venta.id_factura_venta = detalle_factura_venta.id_factura_venta and factura_venta.id_cliente = clientes.id_cliente and clientes.id_cliente = cliente_sector.id_cliente and cliente_sector.id_sector = sectores.id_sectores and sectores.id_sectores = rutas.id_ruta and fecha_actual between '".$_GET['inicio']."' and '".$_GET['fin']."' group by productos.cod_productos,nombre_ruta order by cantidad desc limit 20 ");          
    }else{
        $sql=pg_query("select productos.cod_productos,codigo,articulo, sum(cantidad::int) as cantidad, sum(detalle_factura_venta.total_venta::float),nombre_ruta from factura_venta, detalle_factura_venta,productos,clientes,cliente_sector,sectores,rutas where detalle_factura_venta.cod_productos = productos.cod_productos and factura_venta.id_factura_venta = detalle_factura_venta.id_factura_venta and factura_venta.id_cliente = clientes.id_cliente and clientes.id_cliente = cliente_sector.id_cliente and cliente_sector.id_sector = sectores.id_sectores and sectores.id_sectores = rutas.id_ruta and rutas.id_ruta = '".$_GET['id']."' and fecha_actual between '".$_GET['inicio']."' and '".$_GET['fin']."' group by productos.cod_productos,nombre_ruta order by cantidad desc limit 20 ");        
    }
    
    while($row=pg_fetch_row($sql)){                          
        $pdf->SetX(1);                                  
        $pdf->Cell(40, 6, utf8_decode(maxCaracter($row[1],15)),0,0, 'C',0);                                
        $pdf->Cell(75, 6, utf8_decode(maxCaracter($row[2],40)),0,0, 'L',0);                                
        $pdf->Cell(40, 6, utf8_decode(maxCaracter($row[5],10)),0,0, 'C',0);                
        $pdf->Cell(25, 6, utf8_decode(maxCaracter($row[3],10)),0,0, 'C',0);                                        
        $pdf->Cell(25, 6, utf8_decode(maxCaracter($row[4],20)),0,1, 'C',0);                                               
        //$pdf->Ln(1);                        
    }              
    $pdf->Output();
?>
