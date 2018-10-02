<?php namespace App\Commands;

use App\Commands\Command;
use DB;

use Illuminate\Contracts\Bus\SelfHandling;

class SendEmails extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		

}

}