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
	{ echo 'You need PHP 7.1 minimum on Windows to use the readline function'; }
	else
	{ echo 'This script need the readline extension'; }

	exit;
}

echo "\nWELCOME TO THE ELECTRONIC STORE\n\n",
	"Choose something to buy:\n",
	"1. Console\n",
	"2. Television\n",
	"3. Microwave\n";

$item = null;

switch (readline('Type a number:'))
{
	case '1': $item = new ElectronicItem\Console(); break;
	case '2': $item = new ElectronicItem\Television(); break;
	case '3': $item = new ElectronicItem\Microwave(); break;
}

for ($i=0; $i < 9; ++$i)
{
	echo "Do you want to add an extra to your purchase?\n",
		"0. No thanks\n",
		"1. Yes, add one remote controller\n",
		"2. Yes, add one wired controller";

	$extra = null;

	switch (readline('Type a number:'))
	{
		case '0':
			break 2;

		case '1':
			$extra = new ElectronicItem\Controller();
			$extra->setWired(false);
			break;

		case '2':
			$extra = new ElectronicItem\Controller();
			$extra->setWired(true);
			break;
	}

	if ($extra instanceof ElectronicItem\Controller)
	{
		try
		{
			$item->addExtra($extra);
		}
		catch (Exception $e)
		{
			echo 'Sorry but ' . $e->getMessage();
		}
	}
}

var_dump($item);