<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('UserSeeder');
        $this->call('PostSeeder');
        // $this->call(UsersTableSeeder::class);
    }
}

class UserSeeder extends Seeder{

    /**
     * Run the UserSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();
        User::create([
            'name' => 'Emil',
            'login' => 'grant',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'name' => 'Brian',
            'login' => 'hart',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'name' => 'Harry',
            'login' => 'powell',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'name' => 'Peter',
            'login' => 'franklin',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'name' => 'John',
            'login' => 'freeman',
            'password' => Hash::make('123456'),
        ]);

    }
}

class PostSeeder extends Seeder{

    /**
     * Run the PostsSeeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        DB::table('posts')->truncate();
        Post::create([
            'id_user' => 1,
            'title' => 'Post 1',
            'start_post' => '2016-03-01 12:00:00',
            'preview' => 'Post 1 preview',
            'description' => 'Post 1 description',
        ]);
        Post::create([
            'id_user' => 2,
            'title' => 'Post 2',
            'start_post' => '2016-04-01 12:00:00',
            'preview' => 'Post 2 preview',
            'description' => 'Post 2 description',
        ]);
        Post::create([
            'id_user' => 1,
            'title' => 'Post 3',
            'start_post' => '2016-05-01 12:00:00',
            'preview' => 'Post 3 preview',
            'description' => 'Post 3 description',
        ]);
        Post::create([
            'id_user' => 1,
            'title' => 'Post 4',
            'start_post' => '2016-06-01 13:00:00',
            'preview' => 'Post 4 preview',
            'description' => 'Post 4 description',
        ]);
        Post::create([
            'id_user' => 1,
            'title' => 'Post 5',
            'start_post' => '2016-07-01 12:00:00',
            'preview' => 'Post 5 preview',
            'description' => 'Post 5 description',
        ]);
    }
}


