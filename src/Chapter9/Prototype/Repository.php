<?php
declare(strict_types=1);

namespace Acme\Chapter9\Prototype;

use Acme\Chapter9\Exception\IllegalCloneCallException;

class Repository implements Cloneable
{
    public const  PUBLIC_TYPE  = 'PUBLIC';
    public const  PRIVATE_TYPE = 'PRIVATE';
    public const  FORKED_TYPE  = 'FORKED';

    private $owner;

    private $name;

    private $type;

    private $stars = 0;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    public function __construct(Account $owner, string $name, string $type = self::PUBLIC_TYPE)
    {
        $this->owner = $owner;
        $this->name  = $name;
        $this->type  = $type;

        $this->createdAt = new \DateTimeImmutable();
    }

    public function fullName(): string
    {
        return $this->owner ? "{$this->owner->getUsername()}/{$this->getName()}" : $this->getName();
    }

    public function star(): self
    {
        if ($this->getOwner()) {
            ++$this->stars;
        }

        return $this;
    }

    public function setOwner(Account $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOwner(): ?Account
    {
        return $this->owner;
    }

    public function getStars(): int
    {
        return $this->stars;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function isPrivate(): bool
    {
        return self::PRIVATE_TYPE === $this->getType();
    }

    public function __clone()
    {
        if ($this->isPrivate()) {
            throw new IllegalCloneCallException('You cannot clone private repository '.$this->getName());
        }

        $this->owner = null;
        $this->stars = 0;
        $this->type  = self::FORKED_TYPE;
    }
}
