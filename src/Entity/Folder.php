<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FolderRepository")
 */
class Folder
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="folders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var ArrayCollection|Folder[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Folder", mappedBy="parent")
     */
    private $childFolders;

    /**
     * @var Folder
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Folder", inversedBy="childFolders")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct()
    {
        $this->childFolders = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Folder[]
     */
    public function getChildFolders(): Collection
    {
        return $this->childFolders;
    }

    public function addFolder(Folder $folder): self
    {
        if (!$this->childFolders->contains($folder)) {
            $this->childFolders[] = $folder;
            $folder->setParent($this);
        }

        return $this;
    }

    public function removeFolder(Folder $folder): self
    {
        if ($this->childFolders->contains($folder)) {
            $this->childFolders->removeElement($folder);
            // set the owning side to null (unless already changed)
            if ($folder->getParent() === $this) {
                $folder->setParent(null);
            }
        }

        return $this;
    }

    public function setParent(Folder $parent): Folder
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Folder
     */
    public function getParent(): ?Folder
    {
        return $this->parent;
    }
}
