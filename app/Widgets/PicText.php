<?php


namespace App\Widgets;


use App\Support\Widget\AbstractWidget;
use App\Services\Navigation;

class PicText extends AbstractWidget
{
    public function getData(array $params = [])
    {
        $navigation = app(Navigation::class);
        return [
            'navigation' => $navigation,
            'allNav' => $navigation->getAllNav(),
            'activeTopNav' => $navigation->getActiveTopNav(),
        ];
    }
}
