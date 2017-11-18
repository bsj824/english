<?php

namespace App\Support\Response;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Item;
use League\Fractal\Scope;
use League\Fractal\Resource\Collection as FractalCollection;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;


class TransformerResponse implements Responsable
{
    /**
     * The include query string key.
     *
     * @var string
     */
    protected $includeKey = 'include';

    /**
     * The include separator.
     *
     * @var string
     */
    protected $includeSeparator = ',';

    /**
     * Indicates if eager loading is enabled.
     *
     * @var bool
     */
    protected $eagerLoading = true;

    protected $transformer;

    protected $resource = null;
    protected $meta = [];
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @var FractalManager
     */
    protected static $fractalManager;

    public static function setFractalManager(FractalManager $fractalManager)
    {
        static::$fractalManager = $fractalManager;
    }

    public static function getFractalManager()
    {
        return static::$fractalManager;
    }

    /**
     * @return TransformerResponse
     */
    public function item($item, $transformer = null)
    {
        $this->resource = new Item($item, $transformer);
        if (!is_null($transformer))
            $this->transformer = $transformer;
        return $this;
    }

    public function setTransformer($transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @return TransformerResponse
     */
    public function collection(Collection $collection, $transformer = null)
    {
        $this->resource = new FractalCollection($collection, $transformer);
        if (!is_null($transformer))
            $this->transformer = $transformer;
        return $this;
    }

    /**
     * @return TransformerResponse
     */
    public function paginator(Paginator $paginator, $transformer = null)
    {
        $collection = $paginator->getCollection();
        $this->resource = new FractalCollection($collection, $transformer);
        $this->resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        if (!is_null($transformer))
            $this->transformer = $transformer;
        return $this;
    }

    private function fractalCreateData($scopeIdentifier = null, Scope $parentScopeInstance = null)
    {

        if (!isset(static::$fractalManager)) {
            static::setFractalManager(app(FractalManager::class));
        }

        $this->parseFractalIncludes(request());

        if ($this->shouldEagerLoad($this->resource->getData())) {
            $eagerLoads = $this->mergeEagerLoads($this->transformer, static::$fractalManager->getRequestedIncludes());
            if (!empty($eagerLoads))
                $this->resource->getData()->load($eagerLoads);
        }
        return static::$fractalManager->createData($this->resource, $scopeIdentifier, $parentScopeInstance)->toArray();
    }

    public function toResponse($request)
    {
        $this->resource->setMeta($this->meta);
        $this->response->setContent($this->fractalCreateData());
        return $this->response->toResponse($request);
    }

    /**
     * Set the meta data for the binding.
     *
     * @param array $meta
     *
     * @return TransformerResponse
     */
    public function setMeta(array $meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * Add a meta data key/value pair.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return TransformerResponse
     */
    public function addMeta($key, $value)
    {
        $this->meta[$key] = $value;
        return $this;
    }

    /**
     * Get the binding meta data.
     *
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    public function __call($method, $arguments)
    {
        return $this->response->$method(...$arguments);
    }

    /**
     * Eager loading is only performed when the response is or contains an
     * Eloquent collection and eager loading is enabled.
     *
     * @param mixed $response
     *
     * @return bool
     */
    protected function shouldEagerLoad($data)
    {
        if ($data instanceof Paginator) {
            $data = $data->getCollection();
        }

        return $this->eagerLoading && $data instanceof EloquentCollection;
    }

    /**
     * Parse the includes.
     *
     * @param Request $request
     *
     * @return void
     */
    public function parseFractalIncludes(Request $request)
    {
        $includes = $request->input($this->includeKey);

        if (!is_array($includes)) {
            $includes = array_filter(explode($this->includeSeparator, $includes));
        }

        static::$fractalManager->parseIncludes($includes);
    }

    /**
     * Get includes as their array keys for eager loading.
     *
     * @param \League\Fractal\TransformerAbstract $transformer
     * @param string|array $requestedIncludes
     *
     * @return array
     */
    protected function mergeEagerLoads($transformer, $requestedIncludes)
    {
        $includes = array_merge($requestedIncludes, $transformer->getDefaultIncludes());
        $includes = array_intersect($includes, $transformer->getAvailableIncludes());
        $eagerLoads = [];

        foreach ($includes as $key => $value) {
            $eagerLoads[] = camel_case(is_string($key) ? $key : $value);
        }

        return $eagerLoads;
    }

    /**
     * Disable eager loading.
     *
     * @return TransformerResponse
     */
    public function disableEagerLoading()
    {
        $this->eagerLoading = false;

        return $this;
    }

    /**
     * Enable eager loading.
     *
     * @return TransformerResponse
     */
    public function enableEagerLoading()
    {
        $this->eagerLoading = true;

        return $this;
    }

}