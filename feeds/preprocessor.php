<?php

class Preprocessor { 

	public function filterXmlResponse(\SimpleXmlElement $xml){ 
		$entries = array();

		foreach($xml->entry as $k => $child){
			$meta = $this->transformToDateTime($child->summary);
			$entries[] = $child;
		}

		return $entries;
	}


	public function transformToDateTime(\SimpleXmlElement $element) { 
		$times = $this->parseSummaryForDate($element);

		$startTime = new \DateTime($start.' '.$tz);

		$endTime = strlen($end) > 4 
			? new \DateTime($end.' '.$tz) 
			: ;

		$meta = array(
			'start' => new \DateTime(''),
			'end' => new \DateTime('')
		);

		return $meta;
	}

	public function formatKey($string){
		return ucwords(str_replace('_',' ',$string));
	}

	/*
	 * Manipulates summary field to find start and end dates
	 * @var \SimpleXmlElement
	 * @return array
	 */
	private function parseSummaryForDate(\SimpleXmlElement $summary) {
		$str = strtolower($summary->__toString());

		$duration = substr($str, 0, strpos($str,'<br>'));

		$start = substr($duration, 6, strpos($duration, ' to ') - 6);

		$end = substr($duration, 
			(strpos($duration, 'to')+3), 
			strlen(substr($duration, (strpos($duration, 'to')+3)))-10
		);

		$tz = substr($duration, -3);

		var_dump($start, $end, $tz);

		return array ($start,$end,$tz);
	}
}
