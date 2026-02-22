<?php

namespace LeBarbuCodeur\LaravelArtisan\Tests;

use LeBarbuCodeur\LaravelArtisan\LaravelArtisanFacade;

class LaravelArtisanTest extends TestCase
{
    public function test_get_commands_list_method()
    {
        $this->assertIsArray(LaravelArtisanFacade::getCommandsList());
    }

    public function test_get_list_method()
    {
        $response = $this->get(route('laravel-artisan.list'));
        $response->assertStatus(200);
        $response->assertSeeText(strtoupper('maintenance'));
    }

    public function test_get_play_method_return_error_message()
    {
        $response = $this->get(route('laravel-artisan.play', ['command' => 'test']));
        $response->assertStatus(200);
        $response->assertSeeText(__('laravel-artisan::error.unknown_command'));
        $response->assertSeeText(strtoupper('maintenance'));
    }

    public function test_list_view_receives_base_url()
    {
        $response = $this->get(route('laravel-artisan.list'));
        $response->assertStatus(200);
        $response->assertSee('http://localhost', false);
    }
}
