<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private bool $is_Verified = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link_github = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link_linkedin = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private array $skill = [];

    #[ORM\Column]
    private array $technology = [];

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'users')]
    private Collection $participe;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Comments::class)]
    private Collection $comments;

    public function __construct()
    {
        $this->participe = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->is_Verified;
    }

    public function setIsVerified(bool $is_Verified): self
    {
        $this->is_Verified = $is_Verified;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getLinkGithub(): ?string
    {
        return $this->link_github;
    }

    public function setLinkGithub(?string $link_github): self
    {
        $this->link_github = $link_github;

        return $this;
    }

    public function getLinkLinkedin(): ?string
    {
        return $this->link_linkedin;
    }

    public function setLinkLinkedin(?string $link_linkedin): self
    {
        $this->link_linkedin = $link_linkedin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }



    public function setSkill(array $skill): self
    {

        $this->skill = $skill;

        return $this;
    }

    public function getSkill(): array

    {
        $skill = $this->skill;

        $skill[] = '';

        return array_unique($skill);
    }

    public function getTechnology(): array
    {
        $technology = $this->technology;

        $technology[] = '';

        return array_unique($technology);
    }

    public function setTechnology(?array $technology): self
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getParticipe(): Collection
    {
        return $this->participe;
    }

    public function addParticipe(Project $participe): self
    {
        if (!$this->participe->contains($participe)) {
            $this->participe->add($participe);
        }

        return $this;
    }

    public function removeParticipe(Project $participe): self
    {
        $this->participe->removeElement($participe);

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
            $comment->setIdUser($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdUser() === $this) {
                $comment->setIdUser(null);
            }
        }

        return $this;
    }
}
