<?php
require 'ElectronicItem/ElectronicItems.php';
require 'ElectronicItem/ElectronicItem.php';
require 'ElectronicItem/Console.php';
require 'ElectronicItem/Television.php';
require 'ElectronicItem/Microwave.php';
require 'ElectronicItem/Controller.php';

/**
 * Unit testing.
 * @author Vince <vincent.boursier@gmail.com>
 */
class ElectronicItemsTest extends PHPUnit\Framework\TestCase
{
	public function testScenario()
	{
		$items = new ElectronicItem\ElectronicItems();

		$item = new ElectronicItem\Console();
		$item->setPrice(350.98);
		$items->addItem($item);

		$item = new ElectronicItem\Television();
		$item->setPrice(200);
		$items->addItem($item);

		$item = new ElectronicItem\Television();
		$item->setPrice(150.01);
		$items->addItem($item);

		$item = new ElectronicItem\Microwave();
		$item->setPrice(100);
		$items->addItem($item);

		$this->assertSame(800.99, $items->getTotalPrice());
	}
}