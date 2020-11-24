<?php
/**
 * Command Line Interface.
 */

// Autoloading is not available with PHP in CLI
require 'ElectronicItem/ElectronicItems.php';
require 'ElectronicItem/ElectronicItem.php';
require 'ElectronicItem/Console.php';
require 'ElectronicItem/Television.php';
require 'ElectronicItem/Microwave.php';
require 'ElectronicItem/Controller.php';

if (function_exists('readline') == false)
{
	if (strtolower(substr(PHP_OS, 0, 3)) == 'win')
	{ echo 'You need PHP 7.1 minimum on Windows to use the readline extension!'; }
	else
	{ echo 'You need to install and enable the readline extension in your php.ini'; }

	exit;
}

echo "\nWELCOME TO THE ELECTRONIC STORE\n\n",
	"Choose something to buy:\n",
	"1. Console\n",
	"2. Television\n",
	"3. Microwave\n";

$item = null;

switch (readline('Type a number: '))
{
	case '1': $item = new ElectronicItem\Console(); break;
	case '2': $item = new ElectronicItem\Television(); break;
	case '3': $item = new ElectronicItem\Microwave(); break;
	default: exit;
}

$item->setPrice(round(rand(1,999) / rand(2,3), 2));  // Random price

for ($i=0; $i < $item->maxExtras(); ++$i)
{
	echo "\nDo you want to add an extra to your purchase?\n",
		"0. No thanks\n",
		"1. Yes, add one remote controller\n",
		"2. Yes, add one wired controller\n";

	$extra = new ElectronicItem\Controller();
	$extra->setPrice(round(rand(1,999) / rand(2,3), 2));  // Random price

	switch (readline('Type a number: '))
	{
		case '1': $extra->setWired(false); break;
		case '2': $extra->setWired(true); break;
		default: break 2;
	}

	try
	{ $item->addExtra($extra); }
	catch (Exception $e)
	{ echo "\nSorry but " . $e->getMessage(), "\n"; }
}

$items = new ElectronicItem\ElectronicItems();
$items->addItem($item);

foreach ($items->getSortedItemsByPrice() as $item)
{
	echo "\n", $item->getType(), ' $', $item->getPrice(), "\n";
	$nbExtra = $item->countExtra();

	if ($nbExtra > 0)
	{ echo '+', $nbExtra, ' extra controller $', $item->getExtrasPrice(), "\n"; }
}

echo 'TOTAL = $', $items->getTotalPrice(), "\n";