<?php

namespace App\Support\Widget;


abstract class AbstractWidget
{
    public $cacheTime = false;

    protected $viewName = '';

    protected $config = [];

    public function __construct($config = [])
    {
        $this->mergeConfig($config);
    }

    public function setViewName($viewName)
    {
        $this->viewName = $viewName;
        return $this;
    }

    /**
     * 如果 $this->viewName 为空， 那么默认的 viewName 为 Widget 子类类名
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName ?: 'theme::widgets.' . snake_case(class_basename(get_called_class()));
    }

    public function getData(array $params = [])
    {
        return $params;
    }

    public function render(array $params)
    {
        return view($this->getViewName(), $this->getData($params))->render();
    }

    public function cacheKey(array $params = [])
    {
        return 'widgets.' . serialize($params);
    }

    public function mergeConfig($config)
    {
        if (!empty($config))
            $this->config = array_merge($this->config, $config);
        return $this;
    }
}
