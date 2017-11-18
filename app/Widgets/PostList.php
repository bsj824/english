<?php


namespace App\Widgets;


use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryRepository;
use App\Support\Widget\AbstractWidget;

class PostList extends AbstractWidget
{

    protected $config = [
        'category' => null,
        'limit' => 3,
        'status' => Post::STATUS_PUBLISH
    ];

    private $categoryRepository;

    public function getData(array $params = [])
    {
        if (!$this->categoryRepository) {
            $this->categoryRepository = app(CategoryRepository::class);
        }
        if($this->config['category'] instanceof Category)
            $category = $this->config['category'];
        else
            $category = $this->categoryRepository->findByCateName($this->config['category']);
        return [
            'category' => $category,
            'posts' => Post::applyFilter(collect([
                'category_id' => $category->id,
                'status' => $this->config['status']
            ]))->limit($this->config['limit'])->get()
        ];
    }

}
