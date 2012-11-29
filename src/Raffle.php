<?php
class Raffle implements Countable
{
    protected $_participants = array ();

    public function __construct($participants = null)
    {
        if (null !== $participants) {
            $this->setParticipants($participants);
        }
    }
    public function setParticipants($participantsList)
    {
        $this->_participants = $participantsList;
    }

    public function addParticipant($participant)
    {
        $this->_participants[] = $participant; 
    }

    public function getPartipants()
    {
        return $this->_participants();
    }

    public function getParticipant($idx)
    {
        if (!isset ($this->_participants[$idx])) {
            throw new OutOfBoundsException('This item is not available');
        }
        return $this->_participants[$idx];
    }

    public function count()
    {
        return count($this->_participants);
    }

    public function draw()
    {
        $index = rand(0, $this->count() - 1);
        return $this->getParticipant($index);
    }
}
