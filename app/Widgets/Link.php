<?php


namespace App\Widgets;


use App\Services\CustomOrder;
use App\Support\Widget\AbstractWidget;
use App\Models\Link as LinkModel;

class Link extends AbstractWidget
{

    protected $config = [
        'type' => 'default',
        'limit' => 10,
    ];

    public function getData(array $params = [])
    {
        return [
            'links' => app(CustomOrder::class)
                ->order(LinkModel::byType($this->config['type'])->limit($this->config['limit'])->ancient()->get()),
        ];
    }

}
