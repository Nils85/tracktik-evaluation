<?php
namespace ElectronicItem;

/**
 * A microwave to cook delicious meals.
 * @author Vince <vincent.boursier@gmail.com>
 */
class Microwave extends ElectronicItem
{
	public function __construct()
	{
		$this->type = parent::ELECTRONIC_ITEM_MICROWAVE;
		$this->isWired = false;
		$this->isWireless = false;
	}

	public function maxExtras()
	{
		return 0;
	}
}