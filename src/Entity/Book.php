<?php
/**
 * Created by PhpStorm.
 * User: aniselaroui
 * Date: 03/11/18
 * Time: 23:29
 */

namespace App\Entity;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A book.
 *
 * @ORM\Entity
 *
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "title": "partial", "description": "partial"})
 */
class Book
{
    /**
     * @var int The id of this book.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null The ISBN of this book (or null if doesn't have one).
     *
     * @ORM\Column(nullable=true)
     * @Assert\Isbn
     */
    public $isbn;

    /**
     * @var string The title of this book.
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    public $title;

    /**
     * @var string The description of this book.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $description;

    /**
     * @var string The author of this book.
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    public $author;

    /**
     * @var \DateTimeInterface The publication date of this book.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $publicationDate;

    /**
     * @var Review[] Available reviews for this book.
     *
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book")
     */
    public $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}