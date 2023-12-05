<?php

namespace App\Console\Commands;

use App\Models\Emp;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:addemp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $id = Emp::generateID();
        Emp::create([
            'emp_id' => $id,
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'f_name' => 'admin',
            'l_name' => 'admin',
            'gender' => 'M',
            'birthday' => Carbon::now()->format('Y-m-d'),
            'age' => 23,
            'id_card' => rand(1,13),
            'tel' => rand(0,10),
            'status' => 1,
            'address' => '151643'
        ]);
    }
}
