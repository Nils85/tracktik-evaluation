<?php
namespace ElectronicItem;
use Exception;

/**
 * Generic electronic item.
 */
abstract class ElectronicItem
{
	/**
	 * @var float
	 */
	protected $price;

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var bool
	 */
	protected $isWired = false;
	protected $isWireless = false;

	protected $extras = [];

	const ELECTRONIC_ITEM_TELEVISION = 'television';
	const ELECTRONIC_ITEM_CONSOLE = 'console';
	const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
	const ELECTRONIC_ITEM_EXTRA = 'controller';

	private static $types = array(
		self::ELECTRONIC_ITEM_CONSOLE,
		self::ELECTRONIC_ITEM_MICROWAVE,
		self::ELECTRONIC_ITEM_TELEVISION,
	);

	/**
	 * Get accessor for the item price.
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Get accessor for the item type.
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set accessor for the item price.
	 * @param float $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * Set accessor for the item type.
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Is this item compatible with wired controller?
	 * @return bool
	 */
	public function isWired()
	{
		return $this->isWired;
	}

	/**
	 * Is this item compatible with wireless controller?
	 * @return bool
	 */
	public function isWireless()
	{
		return $this->isWireless;
	}

	/**
	 * Limits the number of extras an electronic item can have.
	 * @return int Max number of extras or 0 for no extra or negative number for unlimited
	 */
	abstract protected function maxExtras();

	/**
	 * Add an extra controller after checking all requirements.
	 * @param \ElectronicItem\Controller $extra
	 * @throws Exception If the limit is reached
	 */
	public function addExtra(Controller $extra)
	{
		if (count($this->extras) == $this->maxExtras())
		{ throw new Exception('You cannot add more than ' . $this->maxExtras() . ' extra with a ' . $this->type); }

		if ($extra->isWired() != $this->isWired())
		{ throw new Exception('You can NOT add more extra with this item'); }

		if ($extra->isWireless() != $this->isWireless())
		{ throw new Exception('You can NOT add more extra with this item'); }

		$this->extras[] = $extra;
	}
}