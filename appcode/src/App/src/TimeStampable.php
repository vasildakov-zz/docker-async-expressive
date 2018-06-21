<?php

namespace App;

use DateTime;

trait TimeStampable
{
    /**
     * @var DateTime
     */
    private $created;

    /**
     * @var DateTime
     */
    private $updated;

    /**
     * @param DateTime $created
     * @return self
     */
    public function setCreated(DateTime $created) : self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated() : DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $updated
     * @return self
     */
    public function setUpdated(DateTime $updated) : self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdated() : DateTime
    {
        return $this->updated;
    }
}