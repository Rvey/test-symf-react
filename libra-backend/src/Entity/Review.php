<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]

#[ApiResource(
    normalizationContext: ['group' => ['book:read']],
    denormalizationContext: ['group' => ['book:write']]
)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['review:read', "review:write"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['review:read', "review:write" , "book:read"])]
    private $fullName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['review:read', "review:write" , "book:read"])]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['review:read', "review:write" , "book:read"])]
    private $comment;

    #[ORM\Column(type: 'date')]
    #[Groups(['review:read', "review:write" , "book:read"])]
    private $creationDate;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'reviews')]
    #[Groups(['review:read', "review:write"])]
    #[ORM\JoinColumn(nullable: false)]
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
