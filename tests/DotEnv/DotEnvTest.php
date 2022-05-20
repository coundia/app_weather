<?php

namespace Tests\DotEnv;

use App\Service\LoadDataService;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class DotEnvTest extends TestCase
{
    /**
     * Get the config from .ENV
     */
    protected function setUp(): void
    {
          LoadDataService::loadDotEnv();
    }

    /***
     * Check if STATUS exist and not Empty STATUS_UP
     */
    public function testStatusDotEnvCannotBeEmpty()
    {
        $this->assertNotEmpty($_ENV["STATUS_UP"], "Le statut [STATUS_UP] est obligatoire dan le fichier .env");
    }
}