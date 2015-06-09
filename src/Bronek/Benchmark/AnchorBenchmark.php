/* Resets
--------------------------------------------------------------------------------*/
<?php

namespace Bronek\Benchmark;

use Athletic\AthleticEvent;

/* General Styling and Structure
--------------------------------------------------------------------------------*/
class AnchorBenchmark extends AthleticEvent
{
    public function setUp()
    {

    }

    /**
     * @iterations 10000
     */
    public function simpleLink()
    {
        $this->linkWrapSimple("test", "test");
    }


    /**
     * @iterations 10000
     */
    public function linkUseDomDocument()
    {
        $this->linkWrap("test", "test");
    }

    private function generateUrl($route, $params)
    {
        return "stub";
    }

    public function linkWrapSimple($string, $route, array $route_params = [], $prefilter = null)
    {
        return "<a href=" . $this->generateUrl($route, $route_params) . '?'.$prefilter . '">some text</a>';
    }

    public function linkWrap($string, $route, array $route_params = [], $prefilter = null)
    {
        if(strlen($string) > 0)
        {
            $dom = new \DOMDocument();
            $new_hyper = $dom->createElement('a');
            $new_hyper->setAttribute('href', $this->generateUrl($route, $route_params).(isset($prefilter) ? '?'.htmlspecialchars($prefilter) : ''));
            $new_hyper->nodeValue = $string;

            return $dom->saveHTML($new_hyper);
        }

        return $string;
    }
}
