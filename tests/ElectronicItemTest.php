<?php
require_once 'ElectronicItem/ElectronicItem.php';
require_once 'ElectronicItem/Console.php';
require_once 'ElectronicItem/Television.php';
require_once 'ElectronicItem/Microwave.php';
require_once 'ElectronicItem/Controller.php';

/**
 * Unit testing.
 * @author Vince <vincent.boursier@gmail.com>
 */
class ElectronicItemTest extends PHPUnit\Framework\TestCase
{
	public function testConsole()
	{
		$item = new ElectronicItem\Console();
		$this->assertSame(\ElectronicItem\ElectronicItem::ELECTRONIC_ITEM_CONSOLE, $item->getType());

		$randomPrice = round(rand(1,999) / rand(2,3), 2);
		$item->setPrice($randomPrice);
		$this->assertSame($randomPrice, $item->getPrice());
		$bool = (bool)rand(0,1);

		for ($i=0; $i < $item->maxExtras(); ++$i)
		{
			$bool = !$bool;
			$extra = new ElectronicItem\Controller();
			$extra->setWired(rand(0,1));
			$item->addExtra($extra);
		}

		$this->expectException(Exception::class);
		$extra = new ElectronicItem\Controller();
		$item->addExtra($extra);
	}

	public function testMicrowave()
	{
		$item = new ElectronicItem\Microwave();
		$this->assertSame(\ElectronicItem\ElectronicItem::ELECTRONIC_ITEM_MICROWAVE, $item->getType());

		$randomPrice = rand(1,999) / rand(2,3);
		$item->setPrice($randomPrice);
		$this->assertSame($randomPrice, $item->getPrice());

		$this->expectException(Exception::class);
		$extra = new ElectronicItem\Controller();
		$extra->setWired(true);
		$item->addExtra($extra);
	}

	public function testTelevision()
	{
		$item = new ElectronicItem\Television();
		$this->assertSame(\ElectronicItem\ElectronicItem::ELECTRONIC_ITEM_TELEVISION, $item->getType());

		$randomPrice = rand(1,999) / rand(2,3);
		$item->setPrice($randomPrice);
		$this->assertSame($randomPrice, $item->getPrice());

		$extra = new ElectronicItem\Controller();
		$extra->setWired(false);
		$item->addExtra($extra);

		$this->expectException(Exception::class);
		$extra = new ElectronicItem\Controller();
		$extra->setWired(true);
		$item->addExtra($extra);
	}
}