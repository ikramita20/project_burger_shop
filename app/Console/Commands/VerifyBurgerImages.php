<?php

namespace App\Console\Commands;
use App\Models\Burger;
use Illuminate\Console\Command;

class VerifyBurgerImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify-burger-images';

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
        $burgers = Burger::all();
    
    foreach ($burgers as $burger) {
        $path = public_path('images/burgers/'.$burger->image);
        if (!file_exists($path)) {
            $this->error("Image manquante: ".$burger->image);
        } else {
            $this->info("OK: ".$burger->image);
        }
    }
    }
}
