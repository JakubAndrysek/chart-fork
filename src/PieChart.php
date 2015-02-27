<?php

namespace Tlapnet\Nette\Chart;

use LogicException;
use Tlapnet\Nette\Chart\Segment\PieSegment;


/**
 * @author Ludek Benedik
 */
class PieChart extends BaseChart
{
	const TYPE_PIE = 'pie';
	const TYPE_DONUT = 'donut';

	const DATA_LABEL_TYPE_VALUE = 'value';
	const DATA_LABEL_TYPE_PERCENTAGE = 'percent';


	/** @var string */
	private $type = self::TYPE_PIE;

	/** @var string */
	private $dataLabelType = self::DATA_LABEL_TYPE_PERCENTAGE;

	/** @var PieSegment[] */
	private $segments = [];


	/**
	 * @param PieSegment $segment
	 */
	public function addSegment(PieSegment $segment)
	{
		$this->segments[] = $segment;
	}


	/**
	 * @param string $type
	 */
	public function setDataLabelType($type)
	{
		static $allowedTypes = array(
			self::DATA_LABEL_TYPE_VALUE,
			self::DATA_LABEL_TYPE_PERCENTAGE,
		);

		if (!in_array($type, $allowedTypes, true)) {
			throw new LogicException("Undefined data label type '$type'.");
		}

		$this->dataLabelType = $type;
	}


	/**
	 * {@inheritdoc}
	 */
	protected function getTemplateParameters()
	{
		$params                  = parent::getTemplateParameters();
		$params['type']          = count($this->series) > 1 ? self::TYPE_DONUT : $this->type;
		$params['dataLabelType'] = $this->dataLabelType;
		$params['segments']      = $this->segments;

		return $params;
	}
}
