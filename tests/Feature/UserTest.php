<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_view_user()
    {
        $response = $this->get('/users/' . $this->user->id);

        $response->assertStatus(200);
    }

    public function test_can_create_user()
    {
        $response = $this->get('/users/' . $this->user->id . 'comment');

        $response->assertStatus(200);
    }

    public function test_invalid_request()
    {
        $request = [
            'password' => 'invalid password',
        ];

        $response = $this->post('/users/' . $this->user->id . '/update', $request);

        $response->assertStatus(302)
            ->assertSessionHasErrors([
                'password' => 'The selected password is invalid.',
                'comment' => 'The comment field is required.',
            ]);
    }

    public function test_invalid_request_json()
    {
        $request = [
            'password' => 'invalid password',
        ];

        $response = $this->postJson('/api/users/' . $this->user->id . '/update', $request);

        $response->assertStatus(422);
    }

    public function test_invalid_command()
    {
        $notExistingUser = rand(10, 100);

        $this->artisan('user:comment ' . $notExistingUser . ' append')->assertFailed();
    }

    public function test_can_append_comment()
    {
        $request = [
            'comment' => 'appended comment',
            'password' => config('user.valid_passwords')[0],
        ];

        $response = $this->post('/users/' . $this->user->id . '/update', $request);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'comments' => $this->user->comments . "\n" . $request['comment'],
        ]);

    }

    public function test_can_append_comment_json()
    {
        $request = [
            'comment' => 'appended comment',
            'password' => config('user.valid_passwords')[0],
        ];

        $response = $this->postJson('/api/users/' . $this->user->id . '/update', $request);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'comments' => $this->user->comments . "\n" . $request['comment'],
        ]);
    }

    public function test_can_append_comment_command()
    {
        $comment = 'appended';

        $this->artisan('user:comment ' . $this->user->id . ' ' . $comment)->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'comments' => $this->user->comments . "\n" . $comment,
        ]);
    }
}
