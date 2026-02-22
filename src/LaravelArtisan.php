<?php

namespace LeBarbuCodeur\LaravelArtisan;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class LaravelArtisan
{
    public array $commands;

    public function __construct()
    {
        $this->commands = [
            'key' => [
                'key-generate' => ['cmd' => 'key:generate', 'description' => __('laravel-artisan::description.key_generate')],
            ],
            'maintenance' => [
                'down' => ['cmd' => 'down', 'description' => __('laravel-artisan::description.down')],
                'optimize' => ['cmd' => 'optimize', 'description' => __('laravel-artisan::description.optimize')],
                'optimize-clear' => ['cmd' => 'optimize:clear', 'description' => __('laravel-artisan::description.optimize_clear')],
                'up' => ['cmd' => 'up', 'description' => __('laravel-artisan::description.up')],
            ],
            'migration' => [
                'migrate' => ['cmd' => 'migrate', 'description' => __('laravel-artisan::description.migrate')],
                'migrate-rollback' => ['cmd' => 'migrate:rollback', 'description' => __('laravel-artisan::description.migrate_rollback')],
                'migrate-status' => ['cmd' => 'migrate:status', 'description' => __('laravel-artisan::description.migrate_status')],
            ],
            'package' => [
                'package-discover' => ['cmd' => 'package:discover', 'description' => __('laravel-artisan::description.package_discover')],
            ],
        ];
    }

    public function getCommandsList(): array
    {
        return $this->commands;
    }

    public function list(): View
    {
        return $this->getViewFor('list', [
            'commands' => $this->getCommandsList(),
        ]);
    }

    public function play(string $command, ?array $commands = []): View
    {
        $cmd = null;
        $commands = empty($commands) ? $this->getCommandsList() : $commands;

        foreach ($this->getCommandsList() as $commands) {
            if (Arr::exists($commands, $command)) {
                $cmd = Arr::get($commands, $command)['cmd'];
            }
        }

        if (is_null($cmd)) {
            return $this->getViewFor('list', [
                'error' => __('laravel-artisan::error.unknown_command'),
                'commands' => $this->getCommandsList(),
            ]);
        }

        try {
            Artisan::call($cmd);

            $output = Artisan::output();
            $result = trim($output) !== '' ? $output : __('laravel-artisan::description.command_success');

            return $this->getViewFor('list', [
                'result' => $result,
                'commands' => $this->getCommandsList(),
            ]);
        } catch (\Exception $e) {
            return $this->getViewFor('list', [
                'error' => $e->getMessage(),
                'commands' => $this->getCommandsList(),
            ]);
        }
    }

    private function getViewFor(string $slug, ?array $datas = []): View
    {
        return view(sprintf('laravel-artisan::%s', $slug), $datas);
    }
}
