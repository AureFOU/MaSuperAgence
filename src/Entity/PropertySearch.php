<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

Class PropertySearch
{
    /*
     * @var int | null
     */
    private $maxPrice;

    /*
     * @var ArrayCollection
     */
    private $options;

    function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /*
     * @var int | null
     * @Assert\Range(min=10, max=400)
     */
    #[Assert\Range(min:10, max:400)]
    private $minSurface;

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     */
    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return mixed
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @param mixed $minSurface
     */
    public function setMinSurface(int $minSurface)
    {
        $this->minSurface = $minSurface;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions() : ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options) : void
    {
        $this->options = $options;
    }
}