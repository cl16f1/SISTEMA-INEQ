<?php
  function GenerarXML(){

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
    $xml_ambiente = $xml->createElement('ambiente','1');
    $xml_tipoEmision = $xml->createElement('tipoEmision','1');
    $xml_razonSocial = $xml->createElement('razonSocial','NOMBRE DE LA EMPRESA S.A');
    $xml_nombreComercial = $xml->createElement('nombreComercial','NOMBRE DE LA EMPRESA S.A');
    $xml_ruc = $xml->createElement('ruc','1234567891478');

    $xml_claveAcceso = $xml->createElement('claveAcceso','1487954321657984315679872135489721567895464578690');
    $xml_codDoc = $xml->createElement('codDoc','01');
    $xml_estab = $xml->createElement('estab','001');
    $xml_ptoEmi = $xml->createElement('ptoEmi','001');
    $xml_secuencial = $xml->createElement('secuencial','000000001');
    $xml_dirMatriz = $xml->createElement('dirMatriz','DIRECCION DE LA EMPRESA');
    //AGENTE DE RETENCION
    
    $xml_infoFactura = $xml->createElement('infoFactura');
    $xml_fechaEmision = $xml->createElement('fechaEmision','21/10/2012');
    $xml_dirEstablecimiento = $xml->createElement('dirEstablecimiento','DIRECCIÓN ESTABLECIMIENTO');
    $xml_obligadoContabilidad = $xml->createElement('obligadoContabilidad','Si');
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
    $xml_moneda = $xml->createElement('moneda','DOLAR');

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
    $xml_cp1 = $xml->createElement('campoAdicional','prueba@yaoo.es');
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

    echo 'CREADO: ' . $xml->save('../../facturasri/no_firmado/'.$clave_acceso.'.xml') .' bytes';
  }
    
  function getMod11Dv( $num ){	
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
?>