<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Packages;
use App\DataStore;

class MoveToStore extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'moveto:store';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */


	public function handle (){
		$size = Packages::get()->count();
		try {
			if ($size > 1000 ){
					$dt =  Packages::orderBy('id', 'DESC')->get()->toArray();
					for ($i= 1000 ; $i<$size ; $i++)
			     		 {
				      	   $store = new DataStore;

				      	   $store->title = $dt[$i]['title'];
				      	   $store->link = $dt[$i]['link'];
				      	   $store->bidder = $dt[$i]['bidder'];
				      	   $store->cate_id = $dt[$i]['cate_id'];
				      	   $store->created_at = $dt[$i]['created_at'];
				      	   $store->updated_at = $dt[$i]['updated_at'];
				      	   $store->save();
				      	   Packages::destroy($dt[$i]['id']);

			     		 }
	    	 }
	  	}catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	}

}
