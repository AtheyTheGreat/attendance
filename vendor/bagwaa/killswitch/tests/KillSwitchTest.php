<?php

class KillSwitchTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \KillSwitch\KillSwitch
     */
    private $killswitch;

    /**
     * KillSwitchTest constructor.
     */
    public function __construct()
    {
        $this->killswitch = new KillSwitch\KillSwitch;
    }

    /**
     * @test
     */
    public function it_can_instantiate()
    {
        $this->assertInstanceOf('KillSwitch\KillSwitch', $this->killswitch);
    }

    /**
     * @test
     */
    public function it_defaults_to_inactive()
    {
        $this->assertFalse($this->killswitch->status());
    }

    /**
     * @test
     */
    public function it_can_set_the_status_with_a_setter()
    {
        $this->assertTrue($this->killswitch->setStatus(true));
    }

    /**
     * @test
     */
    public function it_can_activate_the_kill_switch()
    {
        $this->killswitch->kill();

        $this->assertTrue($this->killswitch->status());
    }

    /**
     * @test
     */
    public function it_will_fail_silently_if_the_switch_url_isnt_accessible()
    {
        $this->killswitch = new \KillSwitch\KillSwitch('fosddsds!!o');
        $this->killswitch->status();
    }

}
