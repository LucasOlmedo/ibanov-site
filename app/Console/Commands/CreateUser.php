<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User Admin';

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
     * @return void
     */
    public function handle()
    {
        try {
            $data = [];
            $data['nome'] = $this->ask('Nome');
            $data['email'] = $this->ask('Email');
            $path = "https://www.gravatar.com/avatar/".md5(strtolower(trim($data['email'])))."?d=identicon&s=250";
            $data['avatar'] = base64_encode(file_get_contents($path));
            $data['password'] = Hash::make($this->ask('Senha'));
            $data['sysAdmin'] = true;
            User::create($data);
            $this->info('Usuário criado com sucesso');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
