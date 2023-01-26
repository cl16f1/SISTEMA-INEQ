<?php
	//date_default_timezone_set('America/Guatemala');
	//Datos empresa
	$query_empresa = mysqli_query($conection,"SELECT * FROM configuracion");
	$num_rows = mysqli_num_rows($query_empresa);

	if($num_rows > 0)
	{
		$arrInfoEmpresa = mysqli_fetch_assoc($query_empresa);
		//dep($arrInfoEmpresa);
		define("RUC_EMPRESA", $arrInfoEmpresa['ruc']);
		define("NOMBRE_EMPRESA", $arrInfoEmpresa['nombre']);
		define("RAZONSOCIAL_EMPRESA", $arrInfoEmpresa['razon_social']);
		define("LOGO_EMPRESA", $arrInfoEmpresa['logotipo']);
		define("TELEFONO_EMPRESA", $arrInfoEmpresa['telefono']);
		define("WHATSAPP", $arrInfoEmpresa['whatsapp']);
		define("FACEBOOK", $arrInfoEmpresa['facebook']);
		define("INSTAGRAM", $arrInfoEmpresa['instagram']);
		define("EMAIL_EMPRESA", $arrInfoEmpresa['email']);
		define("DIRECCION_EMPRESA", $arrInfoEmpresa['direccion']);
		define("IMPUESTO", $arrInfoEmpresa['impuesto']);
		define("MONEDA", $arrInfoEmpresa['moneda']);
		define("SIMBOLO_MONEDA", $arrInfoEmpresa['simbolo_moneda']);
		define("WEB_EMPRESA", $arrInfoEmpresa['sitio_web']);
		define("EMAIL_PEDIDOS", $arrInfoEmpresa['email_pedidos']);
		define("EMAIL_FACTURAS", $arrInfoEmpresa['email_factura']);
		define("ZONA_HORARIA", $arrInfoEmpresa['zona_horaria']);
		define("IDENTIFICACION_CLIENTE", $arrInfoEmpresa['identificacion_cliente']);
		define("IDENTIFICACION_TRIBUTARIA", $arrInfoEmpresa['identificacion_tributaria']);
		define("SPM", $arrInfoEmpresa['separador_millares']);
		define("SPD", $arrInfoEmpresa['separador_decimales']);
	}else{
		define("RUC_EMPRESA", '');
		define("NOMBRE_EMPRESA", '');
		define("RAZONSOCIAL_EMPRESA", '');
		define("LOGO_EMPRESA",'');
		define("TELEFONO_EMPRESA", '');
		define("WHATSAPP", '');
		define("FACEBOOK", '');
		define("INSTAGRAM", '');
		define("EMAIL_EMPRESA", '');
		define("DIRECCION_EMPRESA", '');
		define("IMPUESTO", '');
		define("MONEDA", '');
		define("SIMBOLO_MONEDA", '');
		define("WEB_EMPRESA", '');
		define("EMAIL_PEDIDOS",'');
		define("EMAIL_FACTURAS",'');
		define("ZONA_HORARIA", '');
		define("IDENTIFICACION_CLIENTE", '');
		define("IDENTIFICACION_TRIBUTARIA", '');
		define("SPM", ",");
		define("SPD", ".");
	}
	date_default_timezone_set(ZONA_HORARIA);
	function fechaC(){
		$mes = array("","Enero", 
					  "Febrero", 
					  "Marzo", 
					  "Abril", 
					  "Mayo", 
					  "Junio", 
					  "Julio", 
					  "Agosto", 
					  "Septiembre", 
					  "Octubre", 
					  "Noviembre", 
					  "Diciembre");
		return date('d')." de ". $mes[date('n')] . " de " . date('Y');
	}

	function fntMeses(){
		$meses = array("Enero", 
					  "Febrero", 
					  "Marzo", 
					  "Abril", 
					  "Mayo", 
					  "Junio", 
					  "Julio", 
					  "Agosto", 
					  "Septiembre", 
					  "Octubre", 
					  "Noviembre", 
					  "Diciembre");
		return $meses;
	}
	//Formato Factura
	function formatFactura($factura,$ceros){
		$intFactura = str_pad($factura,$ceros,'0',STR_PAD_LEFT);
		return $intFactura;
	}
	//Elimina exceso de espacios entre palabras
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }

	function encrypt($string, $key) {
	   $result = '';
	   for($i=0; $i<strlen($string); $i++) {
	      $char = substr($string, $i, 1);
	      $keychar = substr($key, ($i % strlen($key))-1, 1);
	      $char = chr(ord($char)+ord($keychar));
	      $result.=$char;
	   }
	   return base64_encode($result);
	}

	function decrypt($string, $key) {
	   $result = '';
	   $string = base64_decode($string);
	   for($i=0; $i<strlen($string); $i++) {
	      $char = substr($string, $i, 1);
	      $keychar = substr($key, ($i % strlen($key))-1, 1);
	      $char = chr(ord($char)-ord($keychar));
	      $result.=$char;
	   }
	   return $result;
	}

	function dep($infoarray){
		print_r('<pre>');
		print_r($infoarray);
		print_r('</pre>');

	}

	function formatCant($cantidad){
		$cantidad = number_format($cantidad,2,SPD,SPM);
		return $cantidad;
	}

	function sendEmail($data,$template)
	{
		$asunto = $data['asunto'];
		$emailDestino = $data['emailDestino'];
		$empresa = NOMBRE_EMPRESA;
		$remitente = $data['emailRemitente'];
		$from = "From: {$empresa} <{$remitente}>";
		//ENVIO DE CORREO
		$de = "MIME-Version: 1.0\n";
		$de .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$de .= "Content-type: text/html; charset=UTF-8\r\n";
		$de .= $from."\r\n";
		//$de .= "From: Nuevo pedido <info@abelosh.com>\r\n";
		ob_start();
	    require_once('template/'.$template.'.php');
	    $mensaje = ob_get_clean();
		$send = mail($emailDestino, $asunto, $mensaje, $de) or die('Hubo un error');
		return $send;
	}
	//Copia una imágen a una ruta determinada
	function copyImage($url_temp,$typeImg,$img_nombre,$max_ancho,$max_alto){
        //Ruta de la original
		//Crear variable de imagen a partir de la original
        if($typeImg == "jpg" || $typeImg == "jpeg" || $typeImg == "pjpeg"){
            $original = @imagecreatefromjpeg($url_temp);
        }else if($typeImg == "png"){
            $original = @imagecreatefrompng($url_temp);
        }else if($typeImg == "gif"){
            $original = @imagecreatefromgif($url_temp);
        }
        //Recoger ancho y alto de la original
        list($ancho,$alto)=getimagesize($url_temp);
        //Calcular proporción ancho y alto
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;

        if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
        //Si es más pequeña que el máximo no redimensionamos
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        //si no calculamos si es más alta o más ancha y redimensionamos
        elseif (($x_ratio * $alto) < $max_alto){
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }else{
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }
        //Crear lienzo en blanco con proporciones
        $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
        //Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
        imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
        //Limpiar memoria
        imagedestroy($original);
        //Definimos la calidad de la imagen final
        $cal=75;
        //Se crea la imagen final en el directorio indicado
        $dataimg = imagejpeg($lienzo,"../img/uploads/".$img_nombre,$cal);
		//move_uploaded_file($url_temp, $src);
        return $dataimg;
    }
	function check_range($fecha_inicio, $fecha_fin, $fecha){
	    $fecha_inicio = strtotime($fecha_inicio);
	    $fecha_fin = strtotime($fecha_fin);
	    $fecha = strtotime($fecha);

	    if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
	        return true;
	    } else {
	        return false;
	    }
	}
	function unidad($numuero){
	switch ($numuero)
	{
	case 9:
	{
	$numu = "NUEVE";
	break;
	}
	case 8:
	{
	$numu = "OCHO";
	break;
	}
	case 7:
	{
	$numu = "SIETE";
	break;
	}
	case 6:
	{
	$numu = "SEIS";
	break;
	}
	case 5:
	{
	$numu = "CINCO";
	break;
	}
	case 4:
	{
	$numu = "CUATRO";
	break;
	}
	case 3:
	{
	$numu = "TRES";
	break;
	}
	case 2:
	{
	$numu = "DOS";
	break;
	}
	case 1:
	{
	$numu = "UNO";
	break;
	}
	case 0:
	{
	$numu = "";
	break;
	}
	}
	return $numu;
	}

	function decena($numdero){

	if ($numdero >= 90 && $numdero <= 99)
	{
	$numd = "NOVENTA ";
	if ($numdero > 90)
	$numd = $numd."Y ".(unidad($numdero - 90));
	}
	else if ($numdero >= 80 && $numdero <= 89)
	{
	$numd = "OCHENTA ";
	if ($numdero > 80)
	$numd = $numd."Y ".(unidad($numdero - 80));
	}
	else if ($numdero >= 70 && $numdero <= 79)
	{
	$numd = "SETENTA ";
	if ($numdero > 70)
	$numd = $numd."Y ".(unidad($numdero - 70));
	}
	else if ($numdero >= 60 && $numdero <= 69)
	{
	$numd = "SESENTA ";
	if ($numdero > 60)
	$numd = $numd."Y ".(unidad($numdero - 60));
	}
	else if ($numdero >= 50 && $numdero <= 59)
	{
	$numd = "CINCUENTA ";
	if ($numdero > 50)
	$numd = $numd."Y ".(unidad($numdero - 50));
	}
	else if ($numdero >= 40 && $numdero <= 49)
	{
	$numd = "CUARENTA ";
	if ($numdero > 40)
	$numd = $numd."Y ".(unidad($numdero - 40));
	}
	else if ($numdero >= 30 && $numdero <= 39)
	{
	$numd = "TREINTA ";
	if ($numdero > 30)
	$numd = $numd."Y ".(unidad($numdero - 30));
	}
	else if ($numdero >= 20 && $numdero <= 29)
	{
	if ($numdero == 20)
	$numd = "VEINTE ";
	else
	$numd = "VEINTI".(unidad($numdero - 20));
	}
	else if ($numdero >= 10 && $numdero <= 19)
	{
	switch ($numdero){
	case 10:
	{
	$numd = "DIEZ ";
	break;
	}
	case 11:
	{
	$numd = "ONCE ";
	break;
	}
	case 12:
	{
	$numd = "DOCE ";
	break;
	}
	case 13:
	{
	$numd = "TRECE ";
	break;
	}
	case 14:
	{
	$numd = "CATORCE ";
	break;
	}
	case 15:
	{
	$numd = "QUINCE ";
	break;
	}
	case 16:
	{
	$numd = "DIECISEIS ";
	break;
	}
	case 17:
	{
	$numd = "DIECISIETE ";
	break;
	}
	case 18:
	{
	$numd = "DIECIOCHO ";
	break;
	}
	case 19:
	{
	$numd = "DIECINUEVE ";
	break;
	}
	}
	}
	else
	$numd = unidad($numdero);
	return $numd;
	}

	function centena($numc){
	if ($numc >= 100)
	{
	if ($numc >= 900 && $numc <= 999)
	{
	$numce = "NOVECIENTOS ";
	if ($numc > 900)
	$numce = $numce.(decena($numc - 900));
	}
	else if ($numc >= 800 && $numc <= 899)
	{
	$numce = "OCHOCIENTOS ";
	if ($numc > 800)
	$numce = $numce.(decena($numc - 800));
	}
	else if ($numc >= 700 && $numc <= 799)
	{
	$numce = "SETECIENTOS ";
	if ($numc > 700)
	$numce = $numce.(decena($numc - 700));
	}
	else if ($numc >= 600 && $numc <= 699)
	{
	$numce = "SEISCIENTOS ";
	if ($numc > 600)
	$numce = $numce.(decena($numc - 600));
	}
	else if ($numc >= 500 && $numc <= 599)
	{
	$numce = "QUINIENTOS ";
	if ($numc > 500)
	$numce = $numce.(decena($numc - 500));
	}
	else if ($numc >= 400 && $numc <= 499)
	{
	$numce = "CUATROCIENTOS ";
	if ($numc > 400)
	$numce = $numce.(decena($numc - 400));
	}
	else if ($numc >= 300 && $numc <= 399)
	{
	$numce = "TRESCIENTOS ";
	if ($numc > 300)
	$numce = $numce.(decena($numc - 300));
	}
	else if ($numc >= 200 && $numc <= 299)
	{
	$numce = "DOSCIENTOS ";
	if ($numc > 200)
	$numce = $numce.(decena($numc - 200));
	}
	else if ($numc >= 100 && $numc <= 199)
	{
	if ($numc == 100)
	$numce = "CIEN ";
	else
	$numce = "CIENTO ".(decena($numc - 100));
	}
	}
	else
	$numce = decena($numc);

	return $numce;
	}

	function miles($nummero){
	if ($nummero >= 1000 && $nummero < 2000){
	$numm = "MIL ".(centena($nummero%1000));
	}
	if ($nummero >= 2000 && $nummero <10000){
	$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
	}
	if ($nummero < 1000)
	$numm = centena($nummero);

	return $numm;
	}

	function decmiles($numdmero){
	if ($numdmero == 10000)
	$numde = "DIEZ MIL";
	if ($numdmero > 10000 && $numdmero <20000){
	$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
	}
	if ($numdmero >= 20000 && $numdmero <100000){
	$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
	}
	if ($numdmero < 10000)
	$numde = miles($numdmero);

	return $numde;
	}

	function cienmiles($numcmero){
	if ($numcmero == 100000)
	$num_letracm = "CIEN MIL";
	if ($numcmero >= 100000 && $numcmero <1000000){
	$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
	}
	if ($numcmero < 100000)
	$num_letracm = decmiles($numcmero);
	return $num_letracm;
	}

	function millon($nummiero){
	if ($nummiero >= 1000000 && $nummiero <2000000){
	$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
	}
	if ($nummiero >= 2000000 && $nummiero <10000000){
	$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
	}
	if ($nummiero < 1000000)
	$num_letramm = cienmiles($nummiero);

	return $num_letramm;
	}

	function decmillon($numerodm){
	if ($numerodm == 10000000)
	$num_letradmm = "DIEZ MILLONES";
	if ($numerodm > 10000000 && $numerodm <20000000){
	$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
	}
	if ($numerodm >= 20000000 && $numerodm <100000000){
	$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
	}
	if ($numerodm < 10000000)
	$num_letradmm = millon($numerodm);

	return $num_letradmm;
	}

	function cienmillon($numcmeros){
	if ($numcmeros == 100000000)
	$num_letracms = "CIEN MILLONES";
	if ($numcmeros >= 100000000 && $numcmeros <1000000000){
	$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
	}
	if ($numcmeros < 100000000)
	$num_letracms = decmillon($numcmeros);
	return $num_letracms;
	}

	function milmillon($nummierod){
	if ($nummierod >= 1000000000 && $nummierod <2000000000){
	$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
	}
	if ($nummierod >= 2000000000 && $nummierod <10000000000){
	$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
	}
	if ($nummierod < 1000000000)
	$num_letrammd = cienmillon($nummierod);

	return $num_letrammd;
	}

	function montoLetras($numero){
	$tempnum = explode('.',$numero);
	if ($tempnum[0] !== ""){
	$numf = milmillon($tempnum[0]);
	if ($numf == "UNO")
	{
	$numf = substr($numf, 0, -1);
	$Ps = " ".MONEDA." CON ";
	}
	else
	{
	$Ps = " ".MONEDA." CON ";
	}
	$TextEnd = $numf;
	$TextEnd .= $Ps;
	}
	if ($tempnum[1] == "" || $tempnum[1] >= 100)
	{
	$tempnum[1] = "00" ;
	}
	$TextEnd .= $tempnum[1] ;
	$TextEnd .= "/100 CENTAVOS";
	return $TextEnd;
	}

	function getMod11Dv($num){	
		$digits = str_replace( array( '.', ',' ), array( ''.'' ), strrev($num ) );
		if ( ! ctype_digit( $digits ) ){
			return false;
		}
		$sum = 0;
		$factor = 2;
		for( $i=0;$i<strlen( $digits ); $i++ ){
			$sum += substr( $digits,$i,1 ) * $factor;
			if ( $factor == 7 ){
			$factor = 2;
			}else{
			$factor++;
			}
		}	 
		$dv = 11 - ($sum % 11);
		if ( $dv == 10 ){
			return 1;
		}
		if ( $dv == 11 ){
			return 0;
		}
		return $dv;
	}
	//$xml_ruc,$xml_nombre,$xml_razon_social
	function GenerarXML($dataxml,$data,$infoFAc,$infoSerie){
		//FECHA DE EMISION
		$fecha = date('dmY');
		
		//TIPO COMPROBANTE
		$tipo_comprobante = '01';
		
		//Numero de RUC
		$num_ruc = '1234567890001';
		
		//TIPO DE AMBIENTE
		// pruebas 1 -- producción 2
		$tipo_ambiente = '1';
		
		//NUMERO DE SERIE
		$serie = '001001';
		
		//Numero del comprobante
		$comprobante = '000000001';
		
		//Codigo Numerico
		$cod_numerico = '12345678';
		
		//Tipo de emision
		$tipo_emision = '1';
		//CLAVE DE ACCESO
		$clave_acceso = $fecha . $tipo_comprobante . $num_ruc . $tipo_ambiente . $serie . $comprobante . $cod_numerico . $tipo_emision;
		
		$clave_acceso = $clave_acceso . getMod11Dv($clave_acceso);

		$xml = new DOMDocument('1.0','utf-8');
		$xml->formatOutput=true;

		$xml_fac = $xml->createElement('factura');
		$cabecera = $xml->createAttribute('id');
		$cabecera->value='comprobante';
		$cabecerav = $xml->createAttribute('version');
		$cabecerav -> value='1.00';

		$xml_InfoTributaria = $xml->createElement('InfoTributaria');
		//AMBIENTE 1 pruebas - AMBIENTE 2 Produccion
		$xml_ambiente = $xml->createElement('ambiente','1');
		//TipoEmision -> Emision normal 1
		$xml_tipoEmision = $xml->createElement('tipoEmision','1');
		$xml_razonSocial = $xml->createElement('razonSocial',$dataxml['razon_social']);
		$xml_nombreComercial = $xml->createElement('nombreComercial',$dataxml['nombre']);
		$xml_ruc = $xml->createElement('ruc',$dataxml['ruc']);

		$xml_claveAcceso = $xml->createElement('claveAcceso',$clave_acceso);
		//CodDodc tipo de comprobante 01 FACTURA
		$xml_codDoc = $xml->createElement('codDoc','01');
		$xml_estab = $xml->createElement('estab','001');
		$xml_ptoEmi = $xml->createElement('ptoEmi','001');
		$xml_secuencial = $xml->createElement('secuencial',formatFactura($infoFAc["factura_serie"]+1,$infoSerie["ceros"]));
		$xml_dirMatriz = $xml->createElement('dirMatriz',$dataxml['direccion']);
		//AGENTE DE RETENCION
		
		$xml_infoFactura = $xml->createElement('infoFactura');
		$xml_fechaEmision = $xml->createElement('fechaEmision',date('d/m/Y'));
		$xml_dirEstablecimiento = $xml->createElement('dirEstablecimiento',$dataxml['direccion']);
		//OBLIGADO A LLEVAR CONTABILIDAD SI o NO
		$xml_obligadoContabilidad = $xml->createElement('obligadoContabilidad','SI');
		//VALIDACION RUC 04 - CEDULA 05 - PASAPORTE 06 - CONSUMIDOR FINAL 07 - IDENTIFIACION DEL EXTERIOR - 08
		$xml_tipoIdentificacionComprador = $xml->createElement('tipoIdentificacionComprador','05');
		// $xml_guiaRemision = $xml->createElement('guiaRemision','001-001-00000001');
		$xml_razonSocialComprador = $xml->createElement('razonSocialComprador','NOMBRE DEL COMPRADOR');
		$xml_identificacionComprador = $xml->createElement('identificacionComprador','0503424146');
		$xml_direccionComprador = $xml->createElement('direccionComprador','0503424146');
		$xml_totalSinImpuesto = $xml->createElement('totalSinImpuesto','0.00');
		$xml_totalDescuento = $xml->createElement('totalDescuento','0.00');

		$xml_totalConImpuestos = $xml->createElement('totalConImpuestos');
		$xml_totalImpuesto = $xml->createElement('totalImpuesto');
		$xml_codigo = $xml->createElement('codigo','2');
		$xml_codigoPorcentaje = $xml->createElement('codigoPorcentaje','0');
		$xml_baseImponible = $xml->createElement('baseImponible','29500.00');
		$xml_valor = $xml->createElement('valor','150.00');

		$xml_propina = $xml->createElement('propina','0.00');
		$xml_importeTotal = $xml->createElement('importeTotal','10.00');
		$xml_moneda = $xml->createElement('moneda',$dataxml['moneda']);

		$xml_pagos = $xml->createElement('pagos');
		$xml_pago = $xml->createElement('pago');
		$xml_formaPago = $xml->createElement('formaPago','01');
		$xml_total = $xml->createElement('total','10.00');
		$xml_plazo = $xml->createElement('plazo','30');
		$xml_unidadTiempo = $xml->createElement('unidadTiempo','dias');

		$xml_detalles = $xml->createElement('detalles');
		$xml_detalle = $xml->createElement('detalle');
		$xml_codigoPrincipal = $xml->createElement('codigoPrincipal','CODIGOPRODUCTO');
		$xml_codigoAuxiliar = $xml->createElement('codigoAuxiliar','CODIGOAUXILIAR');
		$xml_descripcion = $xml->createElement('descripcion','DESCRIPCION DEL PRODUCTO');
		$xml_cantidad = $xml->createElement('cantidad','1');
		$xml_precioUnitario = $xml->createElement('precioUnitario','5.00');
		$xml_descuento = $xml->createElement('descuento','0.00');
		$xml_precioTotalSinImpuesto = $xml->createElement('precioTotalSinImpuesto','0.00');

		$xml_impuestos = $xml->createElement('impuestos');
		$xml_impuesto = $xml->createElement('impuesto');
		$xml_codigo_imp = $xml->createElement('codigo','2');
		$xml_codigoPorcentaje_imp = $xml->createElement('codigoPorcentaje','3072');
		$xml_tarifa = $xml->createElement('tarifa','5');
		$xml_baseImponible_ipm = $xml->createElement('baseImponible','1245.00');
		$xml_valor_imp = $xml->createElement('valor','15.00');

		$xml_infoAdicional = $xml->createElement('infoAdicional');
		$xml_cp1 = $xml->createElement('campoAdicional',$dataxml['email']);
		$atributo = $xml->createAttribute('nombre');
		$atributo->value ='email';

		$xml_InfoTributaria->appendChild($xml_ambiente);
		$xml_InfoTributaria->appendChild($xml_tipoEmision);
		$xml_InfoTributaria->appendChild($xml_razonSocial);
		$xml_InfoTributaria->appendChild($xml_nombreComercial);
		$xml_InfoTributaria->appendChild($xml_ruc);
		$xml_InfoTributaria->appendChild($xml_claveAcceso);
		$xml_InfoTributaria->appendChild($xml_codDoc);
		$xml_InfoTributaria->appendChild($xml_estab);
		$xml_InfoTributaria->appendChild($xml_ptoEmi);
		$xml_InfoTributaria->appendChild($xml_secuencial);
		$xml_InfoTributaria->appendChild($xml_dirMatriz);
		$xml_fac->appendChild($xml_InfoTributaria);

		$xml_infoFactura->appendChild($xml_fechaEmision);
		$xml_infoFactura->appendChild($xml_dirEstablecimiento);
		$xml_infoFactura->appendChild($xml_obligadoContabilidad);
		$xml_infoFactura->appendChild($xml_tipoIdentificacionComprador);
		$xml_infoFactura->appendChild($xml_razonSocialComprador);
		$xml_infoFactura->appendChild($xml_identificacionComprador);
		$xml_infoFactura->appendChild($xml_direccionComprador);
		$xml_infoFactura->appendChild($xml_totalSinImpuesto);
		$xml_infoFactura->appendChild($xml_totalDescuento);
		$xml_infoFactura->appendChild($xml_totalConImpuestos);
		$xml_totalConImpuestos->appendChild($xml_totalImpuesto);
		$xml_totalImpuesto->appendChild($xml_codigo);
		$xml_totalImpuesto->appendChild($xml_codigoPorcentaje);
		$xml_totalImpuesto->appendChild($xml_baseImponible);
		$xml_totalImpuesto->appendChild($xml_valor);
		$xml_fac->appendChild($xml_infoFactura);

		$xml_infoFactura->appendChild($xml_propina);
		$xml_infoFactura->appendChild($xml_importeTotal);
		$xml_infoFactura->appendChild($xml_moneda);

		$xml_infoFactura->appendChild($xml_pagos);
		$xml_pagos->appendChild($xml_pago);
		$xml_pago->appendChild($xml_formaPago);
		$xml_pago->appendChild($xml_total);
		$xml_pago->appendChild($xml_plazo);
		$xml_pago->appendChild($xml_unidadTiempo);

		$xml_fac->appendChild($xml_detalles);
		$xml_detalles->appendChild($xml_detalle);
		$xml_detalle->appendChild($xml_codigoPrincipal);
		$xml_detalle->appendChild($xml_codigoAuxiliar);
		$xml_detalle->appendChild($xml_descripcion);
		$xml_detalle->appendChild($xml_cantidad);
		$xml_detalle->appendChild($xml_precioUnitario);
		$xml_detalle->appendChild($xml_descuento);
		$xml_detalle->appendChild($xml_precioTotalSinImpuesto);
		$xml_detalle->appendChild($xml_impuestos);
		$xml_impuestos->appendChild($xml_impuesto);
		$xml_impuesto->appendChild($xml_codigo_imp);
		$xml_impuesto->appendChild($xml_codigoPorcentaje_imp);
		$xml_impuesto->appendChild($xml_tarifa);
		$xml_impuesto->appendChild($xml_baseImponible_ipm);
		$xml_impuesto->appendChild($xml_valor_imp);

		$xml_fac->appendChild($xml_infoAdicional);
		$xml_infoAdicional->appendChild($xml_cp1);
		$xml_cp1->appendChild($atributo);

		$xml_fac->appendChild($cabecera);
		$xml_fac->appendChild($cabecerav);
		$xml->appendChild($xml_fac);

		$xml->save('../facturasri/no_firmado/'.$clave_acceso.'.xml');
		
		return 1;
	}	 
	

 ?>