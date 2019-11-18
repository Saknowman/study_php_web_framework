<?php


namespace Libs\Routing;


class RoutingTable
{
    protected array $urlPatterns = [];
    private array $tables = [];

    /**
     * Register all $this->urlPatterns if table is empty.
     */
    public function registerMyUrlPatterns()
    {
        if (count($this->tables) > 0)
            return;

        foreach ($this->urlPatterns as $urlPattern) {
            $this->register(
                $urlPattern[0], $urlPattern[1], $urlPattern[2],
                empty($urlPattern[3]) ? 'index' : $urlPattern[3]);
        }
    }

    public function register($pattern, $methodType, $class, $action = 'index')
    {
        if (empty($this->tables[$methodType])) {
            $this->tables[$methodType] = [];
        }
        $pieces = explode('/', $pattern);
        $current_pointer = &$this->tables[$methodType];
        foreach ($pieces as $piece) {
            if (empty($current_pointer[$piece])) {
                $current_pointer[$piece] = [];
            }
            $current_pointer = &$current_pointer[$piece];
        }
        $current_pointer = [
            'class' => $class,
            'action' => $action
        ];
    }

    /**
     * Resolve controller information like this:
     *
     *   return [
     *    'class' => SomeController::class,
     *    'action' => 'index',
     *    'params' => ['id' => 1]
     *   ]
     *
     * Return null if failed to resolve.
     *
     * @param $pathInfo
     * @param $methodType
     * @return array|null
     */
    public function resolve($pathInfo, $methodType)
    {
        if (empty($this->tables[$methodType]))
            return null;

        $params = [];
        $branch = $this->tables[$methodType];
        $pieces = explode('/', $pathInfo);
        for($i = 0; $i < count($pieces); $i++){
            $result = $this->_pickBranch($branch, $pieces[$i], $params);
            if (is_null($result))
                return null;
            $branch = $result;
        }
        if (empty($result['class']) || empty($result['action']))
            return null;
        return ['class' => $result['class'], 'action' => $result['action'], 'params' => $params];
    }

    /**
     * Return null if not found.
     *
     * @param $branch
     * @param $piece
     * @param $params
     * @return mixed|null
     */
    private function _pickBranch($branch, $piece, &$params)
    {
        if (empty($branch[$piece])) {
            list($real_piece, $params) = $this->_pickIntParam($branch, $piece, $params);
            if($real_piece === false){
                list($real_piece, $params) = $this->_pickStrParam($branch, $piece, $params);
            }
            if($real_piece === false)
                return null;
            $piece = $real_piece;
        }
        $result = $branch[$piece];
        return $result;
    }

    /**
     * @param $branch
     * @param $piece
     * @param $params
     * @return array
     */
    private function _pickIntParam($branch, $piece, $params)
    {
        return $this->_pickParam($branch, $piece, $params, '/^\d+$/', 'int');
    }

    private function _pickStrParam($branch, $piece, $params)
    {
        return $this->_pickParam($branch, $piece, $params, '/^.+$/', 'str');
    }

    /**
     * @param $branch
     * @param $piece
     * @param $params
     * @param $value_pattern
     * @param $value_type
     * @return array
     */
    private function _pickParam($branch, $piece, $params, $value_pattern, $value_type){
        if (preg_match($value_pattern, $piece)) {
            foreach (array_keys($branch) as $key) {
                if (preg_match('/' . $value_type . ':(.+)/', $key, $matches)) {
                    $params[$matches[1]] = $piece;
                    $piece = $key;
                    return [$piece, $params];
                }
            }
        }
        return [false, false];
    }
}