<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UsersDataMigrate extends Migration
{
    /**
     * Users admin for sync
     *
     * @var array
     */
    private $users = [
        [
            'email' => 'admin@olistchallenge.com.br',
            'name' => 'Admin Olist Challenge',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ],
    ];

    /**
     * UserRepository
     */
    private $user;

    /**
     * UsersDataMigrate controller
     */
    public function __construct()
    {
        $this->user = app(UserRepositoryInterface::class);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->users as $user) {
            $this->user->create($user);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->users as $user) {
            $this->user->findUserByEmailAndDelete($user['email']);
        }
    }
}
