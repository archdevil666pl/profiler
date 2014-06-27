<?php
/**
 * This file is part of Vegas package
 *
 * @author Radosław Fąfara <radek@archdevil.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Vegas\Profiler\DataCollector;

use Vegas\Profiler\Exception\EventNotTriggeredException;

/**
 * Class Request
 * Provides details about request sent to the server.
 * @package Vegas\Profiler\DataCollector
 */
class Request implements DataCollectorInterface
{
    /**
     * @var mixed
     */
    private $result;
    
    public function getListenerType()
    {
        return 'dispatch';
    }
    
    public function afterDispatchLoop($event)
    {
        $this->result = $event->getSource()->getDi()->get('request')->getHeaders();
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        if (!isset($this->result)) {
            throw new EventNotTriggeredException;
        }
        return $this->result;
    }
    
}