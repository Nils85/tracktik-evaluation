<?php
require 'ElectronicItem/ElectronicItem.php';
require 'ElectronicItem/Console.php';
require 'ElectronicItem/Television.php';
require 'ElectronicItem/Microwave.php';
require 'ElectronicItem/Controller.php';

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

		$randomPrice = rand(1,999) / rand(2,3);
		$item->setPrice($randomPrice);
		$this->assertSame($randomPrice, $item->getPrice());

		for ($i=0; $i < $item->maxExtras(); ++$i)
		{
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
		$extra->setWired(true);
		$item->addExtra($extra);

		$this->expectException(Exception::class);
		$extra = new ElectronicItem\Controller();
		$item->addExtra($extra);
	}
}