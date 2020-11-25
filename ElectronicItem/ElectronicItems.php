<?php
namespace ElectronicItem;

/**
 * List of electronic items.
 */
class ElectronicItems
{
	/**
	 * @var ElectronicItem[]
	 */
	private $items = array();

	// Constructor not needed...
	//public function __construct(array $items)
	//{
	//	$this->items = $items;
	//}

	/**
	 * Add one new ElectronicItem in the list.
	 * @param \ElectronicItem\ElectronicItem $item
	 */
	public function addItem(ElectronicItem $item)
	{
		$this->items[] = $item;
	}

	/**
	 * Returns the items depending on the sorting type requested.
	 * @param bool $reverseOrder True for descending order or false for ascending order
	 * @return array
	 */
	public function getSortedItemsByPrice($reverseOrder = false)
	{
		$order = [];

		foreach ($this->items as $key => $item)
		{ $order[$key] = $item->getPrice() + $item->getExtrasPrice(); }

		if ($reverseOrder)
		{ arsort($order, SORT_NUMERIC); }
		else
		{ asort($order, SORT_NUMERIC); }

		$sorted = [];

		foreach ($order as $key => $unused)
		{ $sorted[] = $this->items[$key]; }

		return $sorted;
	}

	/**
	 * Returns specific type of items.
	 * @param string $type
	 * @return \ElectronicItem\ElectronicItem[] | false
	 */
	public function getItemsByType($type)
	{
		if (in_array($type, ElectronicItem::TYPES))
		{
			$callback = function($item) use ($type)
			{
				return $item->getType() == $type;
			};

			return array_filter($this->items, $callback);
		}

		return false;
	}

	/**
	 * Do the math for the total price of all items in the list.
	 * @return float
	 */
	public function getTotalPrice()
	{
		$total = 0.0;

		foreach ($this->items as $item)
		{ $total += $item->getPrice() + $item->getExtrasPrice(); }

		return $total;
	}
}