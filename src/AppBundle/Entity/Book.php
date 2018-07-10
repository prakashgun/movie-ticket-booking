<?php

namespace AppBundle\Entity;

use AppBundle\Entity\User;

/**
 * Book
 */
class Book
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $seats;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $showTime;

    /**
    * @var User
    **/
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     *
     * @return Book
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return int
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Book
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set showTime
     *
     * @param string $showTime
     *
     * @return Book
     */
    public function setShowTime($showTime)
    {
        $this->showTime = $showTime;

        return $this;
    }

    /**
     * Get showTime
     *
     * @return string
     */
    public function getShowTime()
    {
        return $this->showTime;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }
}

