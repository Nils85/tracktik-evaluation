<?php
require_once 'ElectronicItem/ElectronicItems.php';
require_once 'ElectronicItem/ElectronicItem.php';
require_once 'ElectronicItem/Console.php';
require_once 'ElectronicItem/Television.php';
require_once 'ElectronicItem/Microwave.php';
require_once 'ElectronicItem/Controller.php';

/**
 * Unit testing.
 * @author Vince <vincent.boursier@gmail.com>
 */
class ElectronicItemsTest extends PHPUnit\Framework\TestCase
{
	static $items;

	/**
	 * Scenario in the question 1.
	 */
	public static function setUpBeforeClass()
	{
		self::$items = new ElectronicItem\ElectronicItems();

		// The console has 2 remote controllers and 2 wired controllers

		$item = new ElectronicItem\Console();
		$item->setPrice(350.98);

		$bool = true;

		for ($i=0; $i < 4; ++$i)
		{
			$bool = !$bool;
			$extra = new ElectronicItem\Controller();
			$extra->setWired($bool);
			$extra->setPrice(20);
			$item->addExtra($extra);
		}

		self::$items->addItem($item);

		// The TV #1 has 2 remote controllers

		$item = new ElectronicItem\Television();
		$item->setPrice(200);

		for ($i=0; $i < 2; ++$i)
		{
			$extra = new ElectronicItem\Controller();
			$extra->setWired(false);
			$extra->setPrice(10);
			$item->addExtra($extra);
		}

		self::$items->addItem($item);

		// The TV #2 has 1 remote controller

		$item = new ElectronicItem\Television();
		$item->setPrice(150.01);

		$extra = new ElectronicItem\Controller();
		$extra->setWired(false);
		$extra->setPrice(10);
		$item->addExtra($extra);

		self::$items->addItem($item);

		// The microwave
		$item = new ElectronicItem\Microwave();
		$item->setPrice(100);
		self::$items->addItem($item);
	}

	/**
	 * Question 1.
	 */
	public function testSortItemsByPrice()
	{
		$lastPrice = 0;

		foreach (self::$items->getSortedItemsByPrice() as $item)
		{
			$price = $item->getPrice() + $item->getExtrasPrice();
			$this->assertGreaterThanOrEqual($lastPrice ,$price);
			$lastPrice = $price;
		}
	}

	/**
	 * Question 1.
	 */
	public function testTotalPricing()
	{
		$this->assertSame(910.99, self::$items->getTotalPrice());
	}

	/**
	 * Answer to the question 2.
	 */
	public function testGetItemsByType()
	{
		$items = self::$items->getItemsByType(\ElectronicItem\ElectronicItem::ELECTRONIC_ITEM_CONSOLE);
		$this->assertSame(350.98, $items[0]->getPrice());
		$this->assertSame(80, $items[0]->getExtrasPrice());
	}
}