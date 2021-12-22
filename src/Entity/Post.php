<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"post_read"}}
 *          },
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"post_details_read"}}
 *          },
 *     }
 * )
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"post_details_read", "post_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"post_details_read", "post_read"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post_details_read", "post_read"})
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    public function setAuthor(UserInterface $author): self
    {
        $this->author = $author;

        return $this;
    }
}
