<?php
declare(strict_types=1);

namespace Acme\Chapter9\Prototype;

class Account
{
    private $username;

    /**
     * @var Repository[]
     */
    private $repositories;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function addRepository(Repository $repository): self
    {
        if ($this->getRepository($repository->getName())) {
            return $this;
        }

        if (null === $repository->getOwner()) {
            $repository->setOwner($this);
        }

        if ($this !== $repository->getOwner()) {
            $fork = clone $repository;
            $fork->setOwner($this);
        }

        $this->repositories [$repository->getName()] = $fork ?? $repository;

        return $this;
    }

    public function getRepository(string $name): ?Repository
    {
        return $this->repositories[$name] ?? null;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
