<?php
/**
 * Created by PhpStorm.
 * User: aniselaroui
 * Date: 03/11/18
 * Time: 23:30
 */

namespace App\Entity;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A review of a book.
 *
 * @ORM\Entity
 *
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"book": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"rating": "DESC"})
 */
class Review
{
    /**
     * @var int The id of this review.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int The rating of this review (between 0 and 5).
     *
     * @ORM\Column(type="smallint")
     * @Assert\Range(min=0, max=5)
     */
    public $rating;

    /**
     * @var string the body of the review.
     *
     * @ORM\Column(type="text")
     */
    public $body;

    /**
     * @var string The author of the review.
     *
     * @ORM\Column
     */
    public $author;

    /**
     * @var \DateTimeInterface The date of publication of this review.
     *
     * @ORM\Column(type="datetime_immutable")
     */
    public $publicationDate;

    /**
     * @var Book The book this review is about.
     *
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     */
    public $book;

    public function getId(): ?int
    {
        return $this->id;
    }
}