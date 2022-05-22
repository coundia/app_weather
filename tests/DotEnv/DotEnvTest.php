<?php

namespace Tests\DotEnv;

use App\Service\LoadDataService;
use PHPUnit\Framework\TestCase;

/**
 * DotEnvTest provides to test the file DotEnv .env
 */
final class DotEnvTest extends TestCase
{
    /**
     * This method is called before each test.
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