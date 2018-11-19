<?php

class Funcoes {

	public function token_crsf($length = 30) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++)
	        $randomString .= $characters[rand(0, $charactersLength - 1)];

	    return $randomString;
	} 

	public function replace($valor) {		
		$valor = strtolower($valor);
		$caracters =			array(" ", "<", ">", "{", "}", "[", "]", "(", ")", "/", "\'", "\"", "~", "^", ";", ":", "!", "@", "#", "$", "%", "¨", "&", "*", "§", "+", "=", "www.", "www", ".com", ".br", "?", ",", "|", "´", "`", "°", "ª", "º", "á", "à", "ã", "â", "ä", "é", "ë", "è", "ê", "í", "ì", "î", "ï", "ó", "ò", "õ", "ô", "ö", "ç", "ú", "ù", "û", "ü", "Á", "À", "Ã", "Â", "Ä", "É", "È", "Ë", "Ê", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Õ", "Ô", "Ö", "Ç", "Ú", "Ù", "Û", "Ü" );
		$substitui_caracters =  array("-", "",  "",  "",  "",  "",  "",  "",  "",  "",  "",	  "",   "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",     "",    "",     "",    "",  "",  "",  "",  "",  "",  "",  "",  "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "c", "u", "u", "u", "u", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "C", "U" ,"U", "U", "U");
		return strtolower(str_replace($caracters, $substitui_caracters,$valor));
		
	}

	public function DataHoraAmerican($data) {
		$dataK = explode(' ', $data);
		$dataK2 = explode(':', $dataK[1]);
		$dataKK = explode('/', $dataK[0]);
		$dataKKK = "$dataKK[2]-$dataKK[1]-$dataKK[0] $dataK2[0]:$dataK2[1]";
		return $dataKKK;
	}
	public function daxFormat($dta) {
		$data_c = explode(' ', $dta);
		$data_c2 = explode('-', $data_c[0]);
		$data_c3 = explode(':', $data_c[1]);
		$data_cc = "$data_c2[2]/$data_c2[1]/$data_c2[0]";
		return $data_cc;
	}
	public function daxFormatIvert($dta) {
		$data_c = explode(' ', $dta);
		$data_c2 = explode('-', $data_c[0]);
		$data_c3 = explode(':', $data_c[1]);
		$data_cc = "$data_c2[0]-$data_c2[1]-$data_c2[2]";
		return $data_cc;
	}
	public function dataEnPt($data, $opcao){
		$data_hora = explode(' ',$data);
		$data_d = explode('-',$data_hora[0]);
		$hora_d = explode(':',$data_hora[1]);
		$dia_d = $data_d[2];
		$mes_d = $data_d[1];
		$ano_d = $data_d[0];

		$first_of_month = gmmktime(0,0,0,$mes_d,$dia_d,$ano_d);	
		$dia_semana = gmstrftime('%w',$first_of_month);	
		switch($dia_semana){
			case 0: $nome_dia = 'Domingo'; break;			case 1: $nome_dia = 'Segunda-Feira'; break;			case 2: $nome_dia = 'Ter&ccedil;a-Feira'; break;
			case 3: $nome_dia = 'Quarta-Feira'; break;		case 4: $nome_dia = 'Quinta-Feira'; break;			case 5: $nome_dia = 'Sexta-Feira'; break;
			case 6: $nome_dia = 'S&aacute;bado'; break;
		}

		switch($mes_d){
			case 01: $nome_mes = 'Janeiro'; break;			case 02: $nome_mes = 'Fevereiro'; break;			case 03: $nome_mes = 'Mar&ccedil;o'; break;
			case 04: $nome_mes = 'Abril'; break;			case 05: $nome_mes = 'Maio'; break;					case 06: $nome_mes = 'Junho'; break;
			case 07: $nome_mes = 'Julho'; break;			case 8:  $nome_mes = 'Agosto'; break;				case 9:  $nome_mes = 'Setembro'; break;
			case 10: $nome_mes = 'Outubro'; break;			case 11: $nome_mes = 'Novembro'; break;				case 12: $nome_mes = 'Dezembro'; break;
		}
		
		switch($mes_d){
			case 01: $nome_mes_abrev = 'JAN'; break;			case 02: $nome_mes_abrev = 'FEV'; break;		case 03: $nome_mes_abrev = 'MAR'; break;
			case 04: $nome_mes_abrev = 'ABR'; break;			case 05: $nome_mes_abrev = 'MAI'; break;		case 06: $nome_mes_abrev = 'JUN'; break;
			case 07: $nome_mes_abrev = 'JUL'; break;			case 8:  $nome_mes_abrev = 'AGO'; break;		case 9:  $nome_mes_abrev = 'SET'; break;
			case 10: $nome_mes_abrev = 'OUT'; break;			case 11: $nome_mes_abrev = 'NOV'; break;		case 12: $nome_mes_abrev = 'DEZ'; break;
		}

		switch ($opcao) {
			case 'dia': $data_final = $dia_d; break;
			case 'ano': $data_final = $ano_d; break;
			case 'nome-do-dia': $data_final = $nome_dia; break;
			case 'mes': $data_final = $mes_d; break;
			case 'nome-do-mes': $data_final = $nome_mes; break;
			case 'nome-mes-abrev': $data_final = $nome_mes_abrev; break;
			case 'data': $data_final = $dia_d.'/'.$mes_d.'/'.$ano_d; break;
			case 'nome-dia-mes': $data_final = $dia_d.' de '.$nome_mesX; break;			
			case 'nome-dia-mes-ano': $data_final = $dia_d.' de '.$nome_mes.' de '.$ano_d; break;
			case 'data-hora':$data_final = $dia_d.'/'.$mes_d.'/'.$ano_d.' às '.$hora_d[0].':'.$hora_d[1]; break;
			case 'hora':$data_final = $hora_d[0].':'.$hora_d[1]; break;
			case 'd-nomemes-ano':$data_final = $dia_d.' '.$nome_mes_abrev.' '.$ano_d; break;
			case 'nm-d-nm-a':$data_final = $nome_dia.', '.$dia_d.' de '.$nome_mes.' de '.$ano_d; break;
			default: $data_final = $dia_d.'/'.$mes_d.'/'.$ano_d.' '.$hora_d[0].':'.$hora_d[1].':'.$hora_d[2]; break;
		}		
		return $data_final;
	}
	public function SubStrTexto($texto, $limite) {
			$texto = strip_tags($texto);
			$texto = substr($texto,0,$limite).(strlen($texto)>$limite ? "..." : "");
			return $texto;
		}
	public function daxCont($dta) {
		$data_c = explode(' ', $dta);
		$data_c2 = explode('-', $data_c[0]);
		$data_c3 = explode(':', $data_c[1]);
		$data_cc = "$data_c2[2]/$data_c2[1]/$data_c2[0] $data_c3[0]:$data_c3[1]";
		return $data_cc;
	}
}