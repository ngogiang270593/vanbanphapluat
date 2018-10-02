<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use App\GoiThau;
use App\User;
use App\Http\Controllers\MotGoiThau;
use App\SentEmail;
use Illuminate\Http\Request;

class emailUser extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'email:user';

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
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $data = DB::select("select * from users where status = '1' and level = '1' and receive_email = '1' ");

        $title = 'Đây là mail mới nhất';
        foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords')->where('user_id', $id)->get();
            $noidung = array();

            $count = 0;
            foreach ($tukhoa as $bac2) {
                $key = $bac2->keyword;
                $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' order by id DESC");

                foreach ($goithau as $key => $value) {
                    $id_cankiemtra = $value->id;
                    $id_taikhoan = $id;
                    $ketquakiemtra = DB::select("select * from sent_emails where user_id='$id_taikhoan' and package_id ='$id_cankiemtra'");


                    if (count($ketquakiemtra) == 0) {
                        //echo $value->title;                                 
                        array_push($noidung, $value);
                        $sent_emails = new SentEmail;
                        $sent_emails->user_id = $id_taikhoan;
                        $sent_emails->package_id = $id_cankiemtra;
                        $sent_emails->save();
                    }
                }
            }

            $count = count($noidung);
            echo $count;
            // Gửi email                
            if ($count > 0) {
                Mail::send('process.email', array('noidung' => $noidung, 'count' => $count, 'name' => $user_name, 'keyword' => $tukhoa), function($message) use ($mail) {
                    $message->to($mail)->subject('Thông Tin Gói Thầu');
                });
                //return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
            }
            //   return    ProcessController::GuiGoiThau($mail,$noidung);
        }
    }

}
