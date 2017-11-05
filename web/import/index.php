<?php
$stop = 11;
$sql = 'INSERT INTO produkt (nazwa, porcja, cena, kalorii, bialka, wegle, tluszcze, usun, user_id, kategoria) VALUES \r\n';
for($ii = 1; $ii <= $stop; $ii++)
{
	echo $ii.':';
	libxml_use_internal_errors(true);
	$url = 'http://kalkulatorkalorii.net/tabela-kalorii/'.$ii.'/k-11#wynik';
	$content = file_get_contents($url);
	//$doc = new \DOMDocument;
	//doc->loadHTML($url);

	$kategoria = 'Kasze, makarony, zboża';

	$dom = new DOMDocument;
	libxml_use_internal_errors(true);
	$dom->loadHTML($content);
	libxml_clear_errors();
	$xpath = new DOMXPath($dom);

	$plik = 'ryze.sql';

	$cells = $xpath->query('//table//tr');
	$i = 0;
	$ar = [];
	foreach ($cells as $tr) {
		$trr = $xpath->query('.//td', $tr);
		$i = 0;
		$arr = [];
		foreach($trr as $td)
		{
			if($i == 0)
				$arr['nazwa'] = trim($td->textContent);		
			if($i == 1)
				$arr['kalorii'] = str_replace(',', '.', trim($td->textContent));
			if($i == 2)
				$arr['bialka'] = str_replace(',', '.', trim($td->textContent));
			if($i == 3)
				$arr['wegli'] = str_replace(',', '.', trim($td->textContent));
			if($i == 4)
				$arr['tluszczy'] = str_replace(',', '.', trim($td->textContent));
			++$i;
		}
		
		
		if(!empty($arr))
			$sql .= "('".$arr['nazwa']."', 100, 0, ".$arr['kalorii'].", ".$arr['bialka'].", ".$arr['wegli'].", ".$arr['tluszczy'].", 0, NULL, '".$kategoria."'),\r\n";
	}

}
	file_put_contents($plik, $sql, FILE_APPEND);
die;