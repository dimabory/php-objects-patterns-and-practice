<?php
declare(strict_types=1);

namespace Acme\Chapter9\Prototype;

use Acme\Chapter9\Exception\RepositoryNotFoundException;

class Account
{
    private $username;

    /**
     * @var Repository[]
     */
    private $repositories = [];

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function addRepository(Repository $repository)
    {
        if ($this->hasRepository($repository->getName())) {
            return;
        }

        if (null === $repository->getOwner()) {
            $repository->setOwner($this);
        }

        if ($this !== $repository->getOwner()) {
            $fork = clone $repository;
            $fork->setOwner($this);
        }

        $this->repositories [$repository->getName()] = $fork ?? $repository;
    }

    public function getRepository(string $name): Repository
    {
        if (!$this->hasRepository($name)) {
            throw new RepositoryNotFoundException("{$name} not found");
        }

        return $this->repositories[$name];
    }

    public function hasRepository(string $name): bool
    {
        return array_key_exists($name, $this->repositories);
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
