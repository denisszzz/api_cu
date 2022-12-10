<?php

namespace Proxies\__PM__\Api\Model\Rubric;

class Generated3c7f70f452e5ac174aa4e06d86d4a621 extends \Api\Model\Rubric implements \ProxyManager\Proxy\GhostObjectInterface
{
    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerc1955 = null;

    /**
     * @var bool tracks initialization status - true while the object is initializing
     */
    private $initializationTracker26610 = false;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesb6539 = [
        
    ];

    /**
     * @var array[][] visibility and default value of defined properties, indexed by
     * property name and class name
     */
    private static $privateProperties8bcd4 = [
        'title' => [
            'Api\\Model\\Rubric' => true,
        ],
        'seo' => [
            'Api\\Model\\Rubric' => true,
        ],
        'title_slug' => [
            'Api\\Model\\Rubric' => true,
        ],
        'menu' => [
            'Api\\Model\\Rubric' => true,
        ],
        'sections' => [
            'Api\\Model\\Rubric' => true,
        ],
        'formats' => [
            'Api\\Model\\Rubric' => true,
        ],
        'theme' => [
            'Api\\Model\\Rubric' => true,
        ],
        'vbros' => [
            'Api\\Model\\Rubric' => true,
        ],
    ];

    /**
     * @var string[][] declaring class name of defined protected properties, indexed by
     * property name
     */
    private static $protectedPropertiesfc1e9 = [
        
    ];

    private static $signature3c7f70f452e5ac174aa4e06d86d4a621 = 'YTo0OntzOjk6ImNsYXNzTmFtZSI7czoxNjoiQXBpXE1vZGVsXFJ1YnJpYyI7czo3OiJmYWN0b3J5IjtzOjQ0OiJQcm94eU1hbmFnZXJcRmFjdG9yeVxMYXp5TG9hZGluZ0dob3N0RmFjdG9yeSI7czoxOToicHJveHlNYW5hZ2VyVmVyc2lvbiI7czo0ODoidjEuMC4xMkA4NDE5ZjAxNTg3MTViMzBkNGI5OWE1YmQzN2M2YTM5NjcxOTk0YWQ3IjtzOjEyOiJwcm94eU9wdGlvbnMiO2E6MTp7czoxNzoic2tpcHBlZFByb3BlcnRpZXMiO2E6MTp7aTowO3M6MjA6IgBBcGlcTW9kZWxcUnVicmljAGlkIjt9fX0=';

    /**
     * Triggers initialization logic for this ghost object
     *
     * @param string  $methodName
     * @param mixed[] $parameters
     *
     * @return mixed
     */
    private function callInitializerf8408($methodName, array $parameters)
    {
        if ($this->initializationTracker26610 || ! $this->initializerc1955) {
            return;
        }

        $this->initializationTracker26610 = true;

        static $cacheApi_Model_Rubric;

        $cacheApi_Model_Rubric ?? $cacheApi_Model_Rubric = \Closure::bind(static function ($instance) {
            $instance->title = null;
            $instance->seo = null;
            $instance->title_slug = null;
            $instance->menu = null;
            $instance->sections = null;
            $instance->formats = null;
            $instance->theme = null;
            $instance->vbros = null;
        }, null, 'Api\\Model\\Rubric');

        $cacheApi_Model_Rubric($this);




        $properties = [

        ];

        static $cacheFetchApi_Model_Rubric;

        $cacheFetchApi_Model_Rubric ?? $cacheFetchApi_Model_Rubric = \Closure::bind(function ($instance, array & $properties) {
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'title'] = & $instance->title;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'seo'] = & $instance->seo;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'title_slug'] = & $instance->title_slug;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'menu'] = & $instance->menu;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'sections'] = & $instance->sections;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'formats'] = & $instance->formats;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'theme'] = & $instance->theme;
            $properties['' . "\0" . 'Api\\Model\\Rubric' . "\0" . 'vbros'] = & $instance->vbros;
        }, $this, 'Api\\Model\\Rubric');

        $cacheFetchApi_Model_Rubric($this, $properties);

        $result = $this->initializerc1955->__invoke($this, $methodName, $parameters, $this->initializerc1955, $properties);
        $this->initializationTracker26610 = false;

        return $result;
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Api\Model\Rubric $instance) {
            unset($instance->title, $instance->seo, $instance->title_slug, $instance->menu, $instance->sections, $instance->formats, $instance->theme, $instance->vbros);
        }, $instance, 'Api\\Model\\Rubric')->__invoke($instance);

        $instance->initializerc1955 = $initializer;

        return $instance;
    }

    public function & __get($name)
    {
        $this->initializerc1955 && ! $this->initializationTracker26610 && $this->callInitializerf8408('__get', array('name' => $name));

        if (isset(self::$publicPropertiesb6539[$name])) {
            return $this->$name;
        }

        if (isset(self::$protectedPropertiesfc1e9[$name])) {
            if ($this->initializationTracker26610) {
                return $this->$name;
            }

            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesfc1e9[$name];

            if ($object instanceof $expectedType) {
                return $this->$name;
            }

            $class = isset($caller['class']) ? $caller['class'] : '';

            if ($class === $expectedType || is_subclass_of($class, $expectedType) || $class === 'ReflectionProperty') {
                return $this->$name;
            }
        } elseif (isset(self::$privateProperties8bcd4[$name])) {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';

            static $accessorCache = [];

            if (isset(self::$privateProperties8bcd4[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function & ($instance) use ($name) {
                        return $instance->$name;
                    }, null, $class);

                return $accessor($this);
            }

            if ($this->initializationTracker26610 || 'ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8bcd4[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function & ($instance) use ($name) {
                        return $instance->$name;
                    }, null, $tmpClass);

                return $accessor($this);
            }
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializerc1955 && $this->callInitializerf8408('__set', array('name' => $name, 'value' => $value));

        if (isset(self::$publicPropertiesb6539[$name])) {
            return ($this->$name = $value);
        }

        if (isset(self::$protectedPropertiesfc1e9[$name])) {
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesfc1e9[$name];

            if ($object instanceof $expectedType) {
                return ($this->$name = $value);
            }

            $class = isset($caller['class']) ? $caller['class'] : '';

            if ($class === $expectedType || is_subclass_of($class, $expectedType) || $class === 'ReflectionProperty') {
                return ($this->$name = $value);
            }
        } elseif (isset(self::$privateProperties8bcd4[$name])) {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';

            static $accessorCache = [];

            if (isset(self::$privateProperties8bcd4[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance, $value) use ($name) {
                        return ($instance->$name = $value);
                    }, null, $class);

                return $accessor($this, $value);
            }

            if ('ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8bcd4[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance, $value) use ($name) {
                        return ($instance->$name = $value);
                    }, null, $tmpClass);

                return $accessor($this, $value);
            }
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializerc1955 && $this->callInitializerf8408('__isset', array('name' => $name));

        if (isset(self::$publicPropertiesb6539[$name])) {
            return isset($this->$name);
        }

        if (isset(self::$protectedPropertiesfc1e9[$name])) {
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesfc1e9[$name];

            if ($object instanceof $expectedType) {
                return isset($this->$name);
            }

            $class = isset($caller['class']) ? $caller['class'] : '';

            if ($class === $expectedType || is_subclass_of($class, $expectedType)) {
                return isset($this->$name);
            }
        } else {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';

            static $accessorCache = [];

            if (isset(self::$privateProperties8bcd4[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        return isset($instance->$name);
                    }, null, $class);

                return $accessor($this);
            }

            if ('ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8bcd4[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        return isset($instance->$name);
                    }, null, $tmpClass);

                return $accessor($this);
            }
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            return isset($targetObject->$name);
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializerc1955 && $this->callInitializerf8408('__unset', array('name' => $name));

        if (isset(self::$publicPropertiesb6539[$name])) {
            unset($this->$name);

            return;
        }

        if (isset(self::$protectedPropertiesfc1e9[$name])) {
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesfc1e9[$name];

            if ($object instanceof $expectedType) {
                unset($this->$name);

                return;
            }

            $class = isset($caller['class']) ? $caller['class'] : '';

            if ($class === $expectedType || is_subclass_of($class, $expectedType) || $class === 'ReflectionProperty') {
                unset($this->$name);

                return;
            }
        } elseif (isset(self::$privateProperties8bcd4[$name])) {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';

            static $accessorCache = [];

            if (isset(self::$privateProperties8bcd4[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        unset($instance->$name);
                    }, null, $class);

                return $accessor($this);
            }

            if ('ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8bcd4[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        unset($instance->$name);
                    }, null, $tmpClass);

                return $accessor($this);
            }
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializerc1955 && $this->callInitializerf8408('__clone', []);
    }

    public function __sleep()
    {
        $this->initializerc1955 && $this->callInitializerf8408('__sleep', []);

        return array_keys((array) $this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializerc1955 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializerc1955;
    }

    public function initializeProxy() : bool
    {
        return $this->initializerc1955 && $this->callInitializerf8408('initializeProxy', []);
    }

    public function isProxyInitialized() : bool
    {
        return ! $this->initializerc1955;
    }
}
