<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Play game command
 * 
 * @author Sumeet Badiger <badigersumeet@gmail.com>
 */
class PlayGameCommand extends Command
{
    protected static $defaultName = 'app:play-game';

    protected function configure()
    {
        $this->setDescription('Play game!');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $question = new Question('Enter A team players: ');
        $teamADrainLevels = $helper->ask($input, $output, $question);

        $question = new Question('Enter B team players: ');
        $teamBDrainLevels = $helper->ask($input, $output, $question);

        $teamADrainLevels = $this->validatePlayers($teamADrainLevels);
        $teamBDrainLevels = $this->validatePlayers($teamBDrainLevels);

        if (!$teamADrainLevels || !$teamBDrainLevels) {
            $output->writeln('Please enter drain levels for exactly 5 players for both the team');
            return Command::FAILURE;
        }

        // Max drain of team A's is less than team B's max drain, Lose!
        if (max($teamADrainLevels) < max($teamBDrainLevels)) {
            $output->writeln('Lose');
            return Command::SUCCESS;
        }

        foreach ($teamBDrainLevels as $drainB) {
            $winners = array_filter(
                $teamADrainLevels,
                function ($drainA) use ($drainB) {
                    return $drainA > $drainB;
                }
            );

            // If no winners against B player, Lose!
            if (empty($winners)) {
                $output->writeln('Lose');
                return Command::SUCCESS;
            }

            // get winner with minimum drain
            $winner = min($winners);

            // Filter out player who has played and won
            $teamADrainLevels = array_filter(
                $teamADrainLevels,
                function ($item) use ($winner) {
                    return $item !== $winner;
                }
            );
        }

        $output->writeln('Win');
        return Command::SUCCESS;
    }

    /**
     * Validate players and cast values to int
     * @param string $players
     */
    private function validatePlayers($players)
    {
        $players = explode(',', $players);

        if (!is_array($players) || count($players) !== 5) {
            return false;
        }

        return array_map(function ($item) {
            return (int) $item;
        }, $players);
    }
}
