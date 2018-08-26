<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('time_part', array($this, 'timeFilter')),
        );
    }

    public function timeFilter($number, $type='hour')
    {

        $hour = floor($number/ (60 * 60));
        $minute = floor(($number % (60 * 60)) / 60);
        $second = intval($number%60);

        switch ($type) {
            case 'hour':
                return sprintf('%1$02d', $hour);
            case 'minute':
                return sprintf('%1$02d', $minute);
            case 'second':
                return sprintf('%1$02d', $second);
        }
        throw new \InvalidArgumentException('You choice not correct type (\'hour\', \'minute\', \'second\')');
    }
}