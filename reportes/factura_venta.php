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
        }
        function Footer(){            
            
        }               
    }
    //$pdf = new PDF('P','mm','a4');
    $pdf = new PDF('P','mm',array(150,210));
    //$pdf = new PDF('P','mm','a5');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    //$pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(true,0);
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',9);               
    /*cabecera*/
    $sql = "select id_factura_venta,nombres_cli,identificacion,telefono,direccion_cli,nombre_usuario,apellido_usuario,tarifa12,tarifa0,descuento_venta,iva_venta,total_venta,fecha_actual from factura_venta,clientes,usuario where factura_venta.id_cliente = clientes.id_cliente and factura_venta.id_usuario = usuario.id_usuario and id_factura_venta = '".$_GET['id']."'";        
    $sql = pg_query($sql);

    $subtotal12 = 0;
    $subtotal0 = 0;
    $descuento = 0;
    $subtotal = 0;
    $iva12 = 0;
    $total = 0;
    while($row = pg_fetch_row($sql)){        
        $pdf->SetY(37);        
        $pdf->SetX(1);
        $pdf->Cell(25, 6, utf8_decode(''),1,0, 'L',0);                                     
        $pdf->Cell(120, 6, maxCaracter(utf8_decode($row[1]),80),1,1, 'L',0);///cliente

        $pdf->SetX(1);
        $pdf->Cell(25, 8, utf8_decode(''),1,0, 'L',0); ///ruc telf fecha                                    
        $pdf->Cell(35, 8, maxCaracter(utf8_decode($row[2]),15),1,0, 'L',0);                                     
        $pdf->Cell(15, 8, utf8_decode(''),1,0, 'L',0);
        $pdf->Cell(30, 8, maxCaracter(utf8_decode($row[3]),12),1,0, 'L',0);
        $pdf->Cell(15, 8, utf8_decode(''),1,0, 'L',0);        
        $pdf->Cell(25, 8, maxCaracter(utf8_decode($row[12]),12),1,1, 'L',0);

        $pdf->SetX(1);
        $pdf->Cell(25, 7, utf8_decode(''),1,0, 'L',0); ///direccion vendedor
        $pdf->Cell(80, 7, maxCaracter(utf8_decode($row[4]),60),1,0, 'L',0);                                     
        $pdf->Cell(15, 7, utf8_decode(''),1,0, 'L',0);
        $pdf->Cell(25, 7, maxCaracter(utf8_decode($row[5]),10),1,1, 'L',0);        

        $subtotal12 = $row[7];
        $subtotal0 = $row[8];
        $descuento = $row[9];
        $subtotal = $row[7] + $row[8] + $row[9];
        $iva12 = $row[10];
        $total = $row[11];
    }
    /*---------*/
    /*--detalles-*/
    $pdf->Ln(7);
    $sql = "select cantidad,articulo,precio_venta,total_venta from detalle_factura_venta,productos where detalle_factura_venta.cod_productos = productos.cod_productos and id_factura_venta = '".$_GET['id']."'";
    $sql = pg_query($sql);
    while($row = pg_fetch_row($sql)){
        $pdf->SetX(8);
        $pdf->Cell(15, 5, maxCaracter(utf8_decode($row[0]),80),1,0, 'L',0);///cantidad   
        $pdf->Cell(78, 5, maxCaracter(utf8_decode($row[1]),80),1,0, 'L',0);///producto  
        $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[2]),80),1,0, 'L',0);///p u  
        $pdf->Cell(25, 5, maxCaracter(utf8_decode($row[3]),80),1,1, 'L',0);///p v   
    }
    /*------------*/
    /*---pie de pagina---*/
    $pdf->SetY(165);        
    $pdf->Cell(115, 6, maxCaracter(utf8_decode(''),80),1,0, 'L',0);///subtotal 12       
    $pdf->Cell(30, 6, maxCaracter(number_format($subtotal12,2,',','.'),80),1,1, 'L',0);///   
    
    $pdf->Cell(115, 6, maxCaracter(utf8_decode(''),80),1,0, 'L',0);///subtotal 0   
    $pdf->Cell(30, 6, maxCaracter(number_format($subtotal0,2,',','.'),80),1,1, 'L',0);///   

    $pdf->Cell(115, 6, maxCaracter(utf8_decode(''),80),1,0, 'L',0);///DESCUENTO
    $pdf->Cell(30, 6, maxCaracter(number_format($descuento,2,',','.'),80),1,1, 'L',0);///   

    $pdf->Cell(115, 6, maxCaracter(utf8_decode(''),80),1,0, 'L',0);///subtotal
    $pdf->Cell(30, 6, maxCaracter(number_format($subtotal,2,',','.'),80),1,1, 'L',0);///   

    $pdf->Cell(115, 6, maxCaracter(utf8_decode(''),80),1,0, 'L',0);///iva 12
    $pdf->Cell(30, 6, maxCaracter(number_format($iva12,2,',','.'),80),1,1, 'L',0);///   

    $pdf->Cell(115, 6, maxCaracter(utf8_decode(''),80),1,0, 'L',0);///total
    $pdf->Cell(30, 6, maxCaracter(number_format($total,2,',','.'),80),1,1, 'L',0);///   
    /*-------------------*/
    $pdf->Output();
?>
