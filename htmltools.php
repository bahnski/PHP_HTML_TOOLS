<?php
class HTMLTools {
	const CRLF = "\r\n";
	public static function TableWithData($name,array $ConfigArr, array $DataArr) { 
		$html = '<table class="tablesorter" id="'.$name.'">'.self::CRLF;
		$html .= '<thead>'.self::CRLF;
		//Spaltenueberschrift 
		$html .= '<tr>'.self::CRLF;
		foreach($ConfigArr as $key=>$value ){
			switch ($value['filtertyp']){
				case 'input':
					$html .= '<th>'.$value['caption'].'</th>'.self::CRLF;
					break;
				case 'select':
					$html .= '<th class="filter-select exact-match">'.$value['caption'].'</th>'.self::CRLF;
					break;
			}
		}
		$html .= '</tr>'.self::CRLF;
		$html .= '</thead>'.self::CRLF;
		$html .= '<tbody>'.self::CRLF;
		//Daten in die richtigen Spalten schreiben!			
		if(! empty($DataArr)) { 
			foreach($DataArr as $k => $subArr) { 
				$html .= '<tr>'.self::CRLF;
				if(is_array($subArr)) { 
					foreach($ConfigArr as $i => $colValue) {
						$html .= '<td>'.$subArr[$i].'</td>';
					}
				} else { 
					$html .= '<td>'.$k.'</td><td>'.$subArr.'</td>'; 
				} 
				$html .= '</tr>'.self::CRLF; 
			} 
		} 
		$html .= '</tbody>'.self::CRLF;
		$html .= '</table>'.self::CRLF;
		return $html; 
	}
//$arrKlick = array(
//	'TABLENAME' => 'INVENTORY',
//  'CLICKTYPE' => 'ondblclick',
//	'IDFIELDS' => array('CLIENT_ID','INVENTORY_ID'));
	
public static function TableOnlyData(array $ConfigArr, array $DataArr, array $action) { 
		//Daten in die richtigen Spalten schreiben!			
		$html = '';
		if(! empty($DataArr)) { 
			$html = '';
			foreach($DataArr as $k => $subArr) { 
				if (isset($action)){
					$fieldsandvalues='';
					foreach($action['IDFIELDS'] as $f){
						if (strlen($fieldsandvalues) > 0){
							$fieldsandvalues .= ',';
						}
						$fieldsandvalues .= $f.'='.$subArr[$f];
					}
					$html .= '<tr '.$action['CLICKTYPE'].'="open'.$action['TABLENAME'].'('.$fieldsandvalues.')">'.self::CRLF;
				}else{
					$html .= '<tr>'.self::CRLF;
				}
				if(is_array($subArr)) { 
					foreach($ConfigArr as $i => $colValue) {
						$html .= '<td>'.$subArr[$i].'</td>';
					}
				} else { 
					$html .= '<td>'.$k.'</td><td>'.$subArr.'</td>'; 
				} 
				$html .= '</tr>'.self::CRLF; 
			} 
		} 
		return $html; 
	}
}
