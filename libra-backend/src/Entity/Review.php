<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource(denormalizationContext: ['groups' => ['review:write']], normalizationContext: ['groups' => ['review:read']])]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["review:read"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["review:read", "book:read"])]
    private $fullName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["review:read", "book:read"])]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["review:read", "book:read"])]
    private $comment;

    #[ORM\Column(type: 'date')]
    #[Groups(["review:read", "book:read"])]
    private $creationDate;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'reviews')]
    #[Groups(["review:read"])]
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
