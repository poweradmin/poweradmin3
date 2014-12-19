<?php

class SupermasterRepository
{
    public function delete($ip, $hostname)
    {
        $supermaster = Supermaster::whereIp($ip)->whereNameserver($hostname)->delete();

        return $supermaster;
    }
}
