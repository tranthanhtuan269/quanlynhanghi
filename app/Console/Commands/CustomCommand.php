<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        // step 1: get all user to get user
        $users = \DB::table('users')->get();

        // step 2: get all service of this user
        foreach ($users as $user) {
            $services = \DB::table('services')->where('created_by', $user->id)->get();
            foreach ($services as $service) {
                $checkServiceOrder = \App\Service_Order::where('service_id', $service->id)
                            ->where('created_date', $yesterday)
                            ->get();
                if(count($checkServiceOrder) > 0) continue;

                $sql = "SELECT ";
                $sql .= "    CAST(created_at AS DATE) AS 'order_date',";
                $sql .= "    Sum(number_count) AS number ";
                $sql .= "FROM order_detail ";
                $sql .= "WHERE service_id = " . $service->id ;
                $sql .= " AND CAST(created_at AS DATE) = '" . $yesterday . "' ";
                $sql .= "GROUP BY CAST(created_at AS DATE)";
                $sqlRun = \DB::select($sql);

                // step 3: save to database
                if(count($sqlRun) > 0){
                    $serviceOrder = new \App\Service_Order;
                    $serviceOrder->service_id = $service->id;
                    $serviceOrder->service_number = $sqlRun[0]->number;
                    $serviceOrder->created_date = $yesterday;
                    $serviceOrder->save();
                }
            }
        }

        $this->info('running');
    }
}
