<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $weight = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isAvailable = null;

    /**
     * @Assert\Type("integer")
     */
    #[ORM\Column]
    private ?int $qty = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products', fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: true)]
    private ?Category $category = null;    

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(?bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\Length([
            'min' => 2,
            'max' => 50,
            'minMessage' => 'Name must be at least {{ limit }} characters long',
            'maxMessage' => 'Name cannot be longer than {{ limit }} characters',
        ]));

        $metadata->addPropertyConstraint('description', new Assert\Length([
            'min' => 2,
            'max' => 255,
            'minMessage' => 'Description must be at least {{ limit }} characters long',
            'maxMessage' => 'Description cannot be longer than {{ limit }} characters',
        ]));

        $metadata->addPropertyConstraint('weight', new Assert\Length([
            'max' => 20,
            'maxMessage' => 'Description cannot be longer than {{ limit }} characters',
        ]));


         $metadata->addPropertyConstraint('qty', new Assert\Type([
            'type' => 'integer',
            'message' => 'The value {{ value }} is not a valid {{ type }}.',
        ]));


        $metadata->addPropertyConstraint('qty', new Assert\Length([
            'max' => 4,
            'maxMessage' => 'Description cannot be longer than {{ limit }} characters',
        ]));
        

   

    }

    

}
