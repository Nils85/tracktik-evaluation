<?php

/**
 * List of electronic items.
 */
class ElectronicItems
{
	private $items = array();

	public function __construct(array $items)
	{
		$this->items = $items;
	}

	/**
	 * Returns the items depending on the sorting type requested.
	 * @param type $type
	 * @return array
	 */
	public function getSortedItems($type)
	{
		$sorted = [];

		foreach ($this->items as $item)
		{
			$sorted[($item->price * 100)] = $item;
		}

		return ksort($sorted, SORT_NUMERIC);
	}

	/**
	 * Returns specific type of items.
	 * @param string $type
	 * @return array
	 */
	public function getItemsByType($type)
	{
		if (in_array($type, ElectronicItem::$types))
		{
			$callback = function($item) use ($type)
			{
				return $item->type == $type;
			};

			return array_filter($this->items, $callback);
		}

		return false;
	}
}