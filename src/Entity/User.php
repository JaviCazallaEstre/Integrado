<?php

namespace App\Entity;

use App\Entity\Compra;
use App\Entity\Localidad;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellidos;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipoVia;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombreVia;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroVia;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $escalera;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bloque;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $puerta;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $piso;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Compra::class)]
    private $compras;

    #[ORM\ManyToOne(targetEntity: Localidad::class, inversedBy: 'users')]
    private $localidad;

    #[ORM\Column(type: 'integer')]
    private $CodigoPostal;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Carrito::class)]
    private $carritos;


    public function __construct()
    {
        $this->compras = new ArrayCollection();
        $this->carritos = new ArrayCollection();
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
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTipoVia(): ?string
    {
        return $this->tipoVia;
    }

    public function setTipoVia(string $tipoVia): self
    {
        $this->tipoVia = $tipoVia;

        return $this;
    }

    public function getNombreVia(): ?string
    {
        return $this->nombreVia;
    }

    public function setNombreVia(string $nombreVia): self
    {
        $this->nombreVia = $nombreVia;

        return $this;
    }

    public function getNumeroVia(): ?string
    {
        return $this->numeroVia;
    }

    public function setNumeroVia(string $numeroVia): self
    {
        $this->numeroVia = $numeroVia;

        return $this;
    }

    public function getEscalera(): ?string
    {
        return $this->escalera;
    }

    public function setEscalera(?string $escalera): self
    {
        $this->escalera = $escalera;

        return $this;
    }

    public function getBloque(): ?string
    {
        return $this->bloque;
    }

    public function setBloque(?string $bloque): self
    {
        $this->bloque = $bloque;

        return $this;
    }

    public function getPuerta(): ?string
    {
        return $this->puerta;
    }

    public function setPuerta(?string $puerta): self
    {
        $this->puerta = $puerta;

        return $this;
    }

    public function getPiso(): ?string
    {
        return $this->piso;
    }

    public function setPiso(?string $piso): self
    {
        $this->piso = $piso;

        return $this;
    }

    public function getLocalidad(): ?Localidad
    {
        return $this->localidad;
    }

    public function setLocalidad(Localidad $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }


    /**
     * @return Collection<int, Compra>
     */
    public function getCompras(): Collection
    {
        return $this->compras;
    }

    public function addCompra(Compra $compra): self
    {
        if (!$this->compras->contains($compra)) {
            $this->compras[] = $compra;
            $compra->setUsuario($this);
        }

        return $this;
    }

    public function removeCompra(Compra $compra): self
    {
        if ($this->compras->removeElement($compra)) {
            // set the owning side to null (unless already changed)
            if ($compra->getUsuario() === $this) {
                $compra->setUsuario(null);
            }
        }

        return $this;
    }

    public function getCodigoPostal(): ?int
    {
        return $this->CodigoPostal;
    }

    public function setCodigoPostal(int $CodigoPostal): self
    {
        $this->CodigoPostal = $CodigoPostal;

        return $this;
    }

    public function __toString()
    {
        return $this->email;
    }

    /**
     * @return Collection<int, Carrito>
     */
    public function getCarritos(): Collection
    {
        return $this->carritos;
    }

    public function addCarrito(Carrito $carrito): self
    {
        if (!$this->carritos->contains($carrito)) {
            $this->carritos[] = $carrito;
            $carrito->setUsuario($this);
        }

        return $this;
    }

    public function removeCarrito(Carrito $carrito): self
    {
        if ($this->carritos->removeElement($carrito)) {
            // set the owning side to null (unless already changed)
            if ($carrito->getUsuario() === $this) {
                $carrito->setUsuario(null);
            }
        }

        return $this;
    }

}
