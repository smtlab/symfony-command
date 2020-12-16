<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class PlayGameCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:play-game');
        $commandTester = new CommandTester($command);

        // Win
        $commandTester->setInputs(['35,100,20,50,40', '35,10,30,20,90']);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Win', $output);

        // Lose
        $commandTester->setInputs(['35,10,20,50,40', '35,10,30,20,60']);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Lose', $output);

        // validation
        $commandTester->setInputs(['35,10,20,50,40', '35,10,30,20']);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Please enter drain levels for exactly 5 players for both the team', $output);
    }
}
