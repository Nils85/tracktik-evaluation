<?php
namespace ElectronicItem;

/**
 * A controller for an electronic item.
 * @author Vince <vincent.boursier@gmail.com>
 * @todo New abstract class ExtraElectronicItem when we will add something else than a controller as extra...
 */
class Controller extends ElectronicItem
{
	public function __construct()
	{
		$this->type = parent::ELECTRONIC_ITEM_EXTRA;
	}

	public function setWired($isWired)
	{
		$this->isWired = (bool)$isWired;
		$this->isWireless = !$this->isWired;
	}

	public function maxExtras()
	{
		return 0;
	}
}