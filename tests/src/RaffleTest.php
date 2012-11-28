<?php
require_once 'Raffle.php';

class RaffleTest extends PHPUnit_Framework_TestCase
{
    protected $_listOfNames = array (
        'John Doe',
        'Jane Doe',
        'Chuck Norris',
        'Bruce Lee',
        'Angelina Jolie',
        'Brat Pitt',
        'Ice Cube',
        'Witney Huston',
        'Jet Li',
        'Mina Suvari',
    );

    public function testLoadingListOfParticipants()
    {
        $raffle = new Raffle($this->_listOfNames);
        $this->assertSame(10, count($raffle), 'Wrong count for this raffle, expecting 10 participants');
        return $raffle;
    }

    /**
     * @depends testLoadingListOfParticipants
     */
    public function testRandomizingNames($raffle)
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $raffle->draw();
            $this->assertTrue(in_array($result, $this->_listOfNames));
        }
    }
    public function testRandomizingSeesLastEntry()
    {
        $raffle = new Raffle(array ('John Doe'));
        $result = $raffle->draw();
        $this->assertSame('John Doe', $result);
    }
}
