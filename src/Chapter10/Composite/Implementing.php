<?php
declare(strict_types=1);

namespace Acme\Chapter10\Composite;

use Acme\Chapter10\Composite\Exception\InterfaceNotFoundException;

final class Implementing
{
    private $implements;

    public function __construct(string ...$implements)
    {
        $this->assertImplements($implements);
        $this->implements = $implements;
    }

    /**
     * @return string[]
     */
    public function getInterfaces(): array
    {
        return $this->implements;
    }

    private function assertImplements(array $implements): void
    {
        foreach ($implements as $implement) {
            if (!interface_exists($implement)) {
                throw new InterfaceNotFoundException($implement);
            }
        }
    }
}
