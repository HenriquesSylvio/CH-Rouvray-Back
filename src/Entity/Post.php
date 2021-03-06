<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"post_read"}}
 *          },
 *          "post"
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"post_details_read"}}
 *          },
 *          "put",
 *          "patch",
 *          "delete"
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"name": "partial", "content": "partial"},
 * )
 * @ApiFilter(OrderFilter::class, properties={"id"}, arguments={"orderParameterName"="order"})
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"post_details_read", "post_read"})
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
    * @ORM\Column(type="datetime")
    * @Groups({"post_details_read", "post_read"})
    */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post_details_read", "post_read"})
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="belongTo")
     * @Groups({"post_details_read", "post_read"})
     */
    private $comments;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->comments = new ArrayCollection();
    }


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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setBelongTo($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBelongTo() === $this) {
                $comment->setBelongTo(null);
            }
        }

        return $this;
    }
}
