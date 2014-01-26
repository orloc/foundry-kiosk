<?php

class Preprocessor { 

	public function enhanceXmlResponse(\SimpleXmlElement $xml, $group){ 
		$entries = array();

		$index = 0;
		foreach($xml->entry as $k => $child){
			$meta = $this->transformToDateTime($child->summary);
			$child->addChild('meta')
				->addChild('start', $meta['start']);

			$child->meta->addChild('end', $meta['end']);
			$child->meta->addChild('index', $index);
			$child->meta->addChild('group', $group);

			$entries[] = $child;

			$index++;
		}

		return $entries;
	}


	public function transformToDateTime(\SimpleXmlElement $element) { 
		extract($this->parseSummaryForDate($element));

		// if we cant convert the string disregard the meta data
		try { 
			$startTime = new \DateTime($start.' '.$timezone);

			if (strlen($end) > 4) { 
				$endTime = new \DateTime($end.' '.$timezone);
			} else { 
				$date = substr($start, 0, strpos($start, ',')+6);

				$endTime = new \DateTime($date.' '.$timezone);
			}

			return array ('start' => $startTime->format('Y-m-d H:i:s e'), 'end' => $endTime->format('Y-m-d H:i:s e'));
		} catch(\Exception $e) { 
		}
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

		return array ('start' => $start, 'end' => $end, 'timezone' => $tz);
	}
}
