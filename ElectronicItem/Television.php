<?php
namespace ElectronicItem;

/**
 * A television to watch good TV shows.
 * @author Vince <vincent.boursier@gmail.com>
 */
class Television extends ElectronicItem
{
	public function __construct()
	{
		$this->type = parent::ELECTRONIC_ITEM_TELEVISION;
		$this->isWired = false;
		$this->isWireless = true;
	}

	public function maxExtras()
	{
		return -1;
	}
}