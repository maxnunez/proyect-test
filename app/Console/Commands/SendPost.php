<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class SendPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a simple POST request to https://atomic.incfile.com/fakepost';

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
     * @return int
     */
    public function handle()
    {
        for ($i = 0; $i < 10; $i++) {

            $url = 'https://atomic.incfile.com/fakepost';
            $request = '{"send":"true"}';
            //open connection 
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //execute post 
            try {
                $result = curl_exec($ch);
                $err = curl_error($ch);
                if ($err) {
                    echo 'Curl Error' . $err;
                    throw new Exception('no conection');
                } else {
                    $response = json_decode($result, TRUE);
                    print_r($response);
                    echo 'send..';
                }
                //close connection 

            } catch (Exception $ex) {
                echo 'exception' . $ex->getMessage();
            }

            curl_close($ch);
        }
    }
}
