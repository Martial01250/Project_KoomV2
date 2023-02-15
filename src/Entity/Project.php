<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_employees = null;

    #[ORM\Column(length: 255)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $details = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'participe')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'id_project', targetEntity: Comments::class)]
    private Collection $comments;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $project_skill = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $project_technology = [];

    public function __construct()
    {
        $this->created_date = new DateTime();
        $this->users = new ArrayCollection();
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

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getNbEmployees(): ?int
    {
        return $this->nb_employees;
    }

    public function setNbEmployees(?int $nb_employees): self
    {
        $this->nb_employees = $nb_employees;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addParticipe($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeParticipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setIdProject($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdProject() === $this) {
                $comment->setIdProject(null);
            }
        }

        return $this;
    }

    public function getProjectSkill(): array
    {
        $ProjectSkill = $this->project_skill;

        $ProjectSkill[] = '';

        return array_unique($ProjectSkill);
    }

    public function setProjectSkill(?array $project_skill): self
    {
        $this->project_skill = $project_skill;

        return $this;
    }

    public function getProjectTechnology(): array
    {
        $project_technology = $this->project_technology;

        $project_technology[] = '';

        return array_unique($project_technology);
    }

    public function setProjectTechnology(?array $project_technology): self
    {
        $this->project_technology = $project_technology;

        return $this;
    }
}
