<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class BumpComposerVersion extends Command {

	protected $name = 'bump';
	protected $description = 'Bump the composer package version number.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $type = $this->argument('type');
		$bumped_version = ReleaseHelper::bumpVersion($type, true);

        $this->info('Bumping version for "' . $type . '" to ' . $bumped_version);

        if ($bumped_version) {
            $this->info('Version bumped successfully!');
        } else {
            $this->error('Cannot bump version!');
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('type', InputArgument::OPTIONAL, 'major|minor|patch', 'patch'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
