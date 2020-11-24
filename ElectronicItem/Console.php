<?php
namespace ElectronicItem;

/**
 * A console to play video games.
 * @author Vince <vincent.boursier@gmail.com>
 */
class Console extends ElectronicItem
{
	public function __construct()
	{
		$this->type = parent::ELECTRONIC_ITEM_CONSOLE;
		$this->isWired = true;
		$this->isWireless = true;
	}

	public function maxExtras()
	{
		return 4;
	}
}