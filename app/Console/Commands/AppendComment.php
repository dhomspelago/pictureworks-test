<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AppendComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:comment {user} {comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Append another comment to user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find($this->argument('user'));
        if(! $user) {
            $this->error('User not found');
            return 1;
        }

        $user->appendUserComments($this->argument('comment'));

        $this->info('Successfully appended comment');
        return 0;
    }
}
