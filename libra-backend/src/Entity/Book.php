<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource(denormalizationContext: ['groups' => ['book:write']], normalizationContext: ['groups' => ['book:read']])]
#[ApiFilter(SearchFilter::class, properties: ["title", "author", "genre"])]
#[apiFilter(SearchFilter::class, properties: ["title" => "partial"])]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['book:read'])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["author:read", "book:read"])]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["author:read", "book:read"])]
    private $description;

    #[ORM\Column(type: 'date')]
    #[Groups(["author:read", "book:read"])]
    private $publicationDate;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["author:read", "book:read"])]
    private $genre;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'books')]
    #[Groups(['book:read'])]
    private $author;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    #[Groups("book:read")]
    private $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setBook($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getBook() === $this) {
                $review->setBook(null);
            }
        }

        return $this;
    }
}
