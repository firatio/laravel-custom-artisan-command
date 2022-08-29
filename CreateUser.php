<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use \Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    // Exit codes
    public const SUCCESS = 0;
    public const ERROR = 1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with the given name, email and password';

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
        // Read arguments
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Validate the arguments
        try {
            $validator = Validator::make(
                ['name' => $name, 'email' => $email, 'password' => $password], [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8']
            ]);
            $validator->validate();
        } catch (Exception $e) {
            // Display errors
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::ERROR;
        }
        
        // Give feedback
        $this->info("Creating user with name: $name, email: $email and password: $password...");

        // Create user
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        // Give feedback
        $this->info("User has been successfully created!");

        return self::SUCCESS;
    }
}
