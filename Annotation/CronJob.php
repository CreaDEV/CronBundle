<?php
namespace ColourStream\Bundle\CronBundle\Annotation;

/**
 * @Annotation()
 * @Target("CLASS")
 */
use Doctrine\Common\Annotations\Annotation;

class CronJob extends Annotation
{
    public $interval;
    public $firstrun;

    public function getFirstRunDT()
    {
        if ($this->firstrun !== null) {
            $firstTryString = date('Y-m-d') . ' ' . $this->firstrun;
            $firstTry = \DateTime::createFromFormat('Y-m-d H:i:s', $firstTryString);
            if ($firstTry < (new \DateTime())) {
                $firstTry->add((new \DateInterval('PT24H')));
            }
            return $firstTry;
        }

        return (new \DateTime())->add((new \DateInterval($this->interval)));
    }

}
