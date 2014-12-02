<?php

class TimelinemarkupPlugin extends StudIPPlugin implements SystemPlugin {
    
    public function __construct() {
        parent::__construct();
        StudipFormat::addStudipMarkup('timeline', '\[timeline\]', '\[\/timeline\]', 'TimelinemarkupPlugin::Timeline');
        PageLayout::addScript("https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['timeline']}]}");
        PageLayout::addScript($this->getPluginURL() . '/assets/timeline.js');
    }

    public static function Timeline($markup, $matches, $contents) {

        // Create id
        $id = uniqid('timeline');

        preg_match_all("/\((\w|,|.|:)*\)/", $contents, $inputs);

        foreach ($inputs[0] as $entry) {
            $entry = trim($entry, '()');
            $data = explode(',', $entry);
            $data[1] = self::jsonDate($data[1]);
            $data[2] = self::jsonDate($data[2]);

            $rows[] = "['{$data[0]}', {$data[1]}, {$data[2]}]";
        }

        $container = "<div style='height: 300px;' id='$id' class='timeline'>[" . join(',', $rows) . "]</div><script>var $id = [" . join(',', $rows) . "]</script>";
        return $container;
    }

    public static function jsonDate($input) {
        return "new Date(" . date("Y, m, d", strtotime($input.' - 1 month')) . ")";
    }

}
