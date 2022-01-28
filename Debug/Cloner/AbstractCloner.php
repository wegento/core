<?php

namespace WeGento\Core\Debug\Cloner;

use WeGento\Core\Debug\Caster\Caster;
use WeGento\Core\Debug\Exception\ThrowingCasterException;

abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = [
        '__PHP_Incomplete_Class' => ['WeGento\Core\Debug\Caster\Caster', 'castPhpIncompleteClass'],

        'WeGento\Core\Debug\Caster\CutStub' => ['WeGento\Core\Debug\Caster\StubCaster', 'castStub'],
        'WeGento\Core\Debug\Caster\CutArrayStub' => ['WeGento\Core\Debug\Caster\StubCaster', 'castCutArray'],
        'WeGento\Core\Debug\Caster\ConstStub' => ['WeGento\Core\Debug\Caster\StubCaster', 'castStub'],
        'WeGento\Core\Debug\Caster\EnumStub' => ['WeGento\Core\Debug\Caster\StubCaster', 'castEnum'],

        'Closure' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castClosure'],
        'Generator' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castGenerator'],
        'ReflectionType' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castType'],
        'ReflectionGenerator' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castReflectionGenerator'],
        'ReflectionClass' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castClass'],
        'ReflectionFunctionAbstract' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castFunctionAbstract'],
        'ReflectionMethod' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castMethod'],
        'ReflectionParameter' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castParameter'],
        'ReflectionProperty' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castProperty'],
        'ReflectionReference' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castReference'],
        'ReflectionExtension' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castExtension'],
        'ReflectionZendExtension' => ['WeGento\Core\Debug\Caster\ReflectionCaster', 'castZendExtension'],

        'DOMException' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castException'],
        'DOMStringList' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castLength'],
        'DOMNameList' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castLength'],
        'DOMImplementation' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castImplementation'],
        'DOMImplementationList' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castLength'],
        'DOMNode' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castNode'],
        'DOMNameSpaceNode' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castNameSpaceNode'],
        'DOMDocument' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castDocument'],
        'DOMNodeList' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castLength'],
        'DOMNamedNodeMap' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castLength'],
        'DOMCharacterData' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castCharacterData'],
        'DOMAttr' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castAttr'],
        'DOMElement' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castElement'],
        'DOMText' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castText'],
        'DOMTypeinfo' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castTypeinfo'],
        'DOMDomError' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castDomError'],
        'DOMLocator' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castLocator'],
        'DOMDocumentType' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castDocumentType'],
        'DOMNotation' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castNotation'],
        'DOMEntity' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castEntity'],
        'DOMProcessingInstruction' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castProcessingInstruction'],
        'DOMXPath' => ['WeGento\Core\Debug\Caster\DOMCaster', 'castXPath'],

        'XMLReader' => ['WeGento\Core\Debug\Caster\XmlReaderCaster', 'castXmlReader'],

        'ErrorException' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castErrorException'],
        'Exception' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castException'],
        'Error' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castError'],
        'Symfony\Bridge\Monolog\Logger' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'Symfony\Component\DependencyInjection\ContainerInterface' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'Symfony\Component\EventDispatcher\EventDispatcherInterface' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'Symfony\Component\HttpClient\CurlHttpClient' => ['WeGento\Core\Debug\Caster\SymfonyCaster', 'castHttpClient'],
        'Symfony\Component\HttpClient\NativeHttpClient' => ['WeGento\Core\Debug\Caster\SymfonyCaster', 'castHttpClient'],
        'Symfony\Component\HttpClient\Response\CurlResponse' => ['WeGento\Core\Debug\Caster\SymfonyCaster', 'castHttpClientResponse'],
        'Symfony\Component\HttpClient\Response\NativeResponse' => ['WeGento\Core\Debug\Caster\SymfonyCaster', 'castHttpClientResponse'],
        'Symfony\Component\HttpFoundation\Request' => ['WeGento\Core\Debug\Caster\SymfonyCaster', 'castRequest'],
        'WeGento\Core\Debug\Exception\ThrowingCasterException' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castThrowingCasterException'],
        'WeGento\Core\Debug\Caster\TraceStub' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castTraceStub'],
        'WeGento\Core\Debug\Caster\FrameStub' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castFrameStub'],
        'WeGento\Core\Debug\Cloner\AbstractCloner' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'Symfony\Component\ErrorHandler\Exception\SilencedErrorContext' => ['WeGento\Core\Debug\Caster\ExceptionCaster', 'castSilencedErrorContext'],

        'Imagine\Image\ImageInterface' => ['WeGento\Core\Debug\Caster\ImagineCaster', 'castImage'],

        'Ramsey\Uuid\UuidInterface' => ['WeGento\Core\Debug\Caster\UuidCaster', 'castRamseyUuid'],

        'ProxyManager\Proxy\ProxyInterface' => ['WeGento\Core\Debug\Caster\ProxyManagerCaster', 'castProxy'],
        'PHPUnit_Framework_MockObject_MockObject' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'PHPUnit\Framework\MockObject\MockObject' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'PHPUnit\Framework\MockObject\Stub' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'Prophecy\Prophecy\ProphecySubjectInterface' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],
        'Mockery\MockInterface' => ['WeGento\Core\Debug\Caster\StubCaster', 'cutInternals'],

        'PDO' => ['WeGento\Core\Debug\Caster\PdoCaster', 'castPdo'],
        'PDOStatement' => ['WeGento\Core\Debug\Caster\PdoCaster', 'castPdoStatement'],

        'AMQPConnection' => ['WeGento\Core\Debug\Caster\AmqpCaster', 'castConnection'],
        'AMQPChannel' => ['WeGento\Core\Debug\Caster\AmqpCaster', 'castChannel'],
        'AMQPQueue' => ['WeGento\Core\Debug\Caster\AmqpCaster', 'castQueue'],
        'AMQPExchange' => ['WeGento\Core\Debug\Caster\AmqpCaster', 'castExchange'],
        'AMQPEnvelope' => ['WeGento\Core\Debug\Caster\AmqpCaster', 'castEnvelope'],

        'ArrayObject' => ['WeGento\Core\Debug\Caster\SplCaster', 'castArrayObject'],
        'ArrayIterator' => ['WeGento\Core\Debug\Caster\SplCaster', 'castArrayIterator'],
        'SplDoublyLinkedList' => ['WeGento\Core\Debug\Caster\SplCaster', 'castDoublyLinkedList'],
        'SplFileInfo' => ['WeGento\Core\Debug\Caster\SplCaster', 'castFileInfo'],
        'SplFileObject' => ['WeGento\Core\Debug\Caster\SplCaster', 'castFileObject'],
        'SplHeap' => ['WeGento\Core\Debug\Caster\SplCaster', 'castHeap'],
        'SplObjectStorage' => ['WeGento\Core\Debug\Caster\SplCaster', 'castObjectStorage'],
        'SplPriorityQueue' => ['WeGento\Core\Debug\Caster\SplCaster', 'castHeap'],
        'OuterIterator' => ['WeGento\Core\Debug\Caster\SplCaster', 'castOuterIterator'],
        'WeakReference' => ['WeGento\Core\Debug\Caster\SplCaster', 'castWeakReference'],

        'Redis' => ['WeGento\Core\Debug\Caster\RedisCaster', 'castRedis'],
        'RedisArray' => ['WeGento\Core\Debug\Caster\RedisCaster', 'castRedisArray'],
        'RedisCluster' => ['WeGento\Core\Debug\Caster\RedisCaster', 'castRedisCluster'],

        'DateTimeInterface' => ['WeGento\Core\Debug\Caster\DateCaster', 'castDateTime'],
        'DateInterval' => ['WeGento\Core\Debug\Caster\DateCaster', 'castInterval'],
        'DateTimeZone' => ['WeGento\Core\Debug\Caster\DateCaster', 'castTimeZone'],
        'DatePeriod' => ['WeGento\Core\Debug\Caster\DateCaster', 'castPeriod'],

        'GMP' => ['WeGento\Core\Debug\Caster\GmpCaster', 'castGmp'],

        'MessageFormatter' => ['WeGento\Core\Debug\Caster\IntlCaster', 'castMessageFormatter'],
        'NumberFormatter' => ['WeGento\Core\Debug\Caster\IntlCaster', 'castNumberFormatter'],
        'IntlTimeZone' => ['WeGento\Core\Debug\Caster\IntlCaster', 'castIntlTimeZone'],
        'IntlCalendar' => ['WeGento\Core\Debug\Caster\IntlCaster', 'castIntlCalendar'],
        'IntlDateFormatter' => ['WeGento\Core\Debug\Caster\IntlCaster', 'castIntlDateFormatter'],

        'Memcached' => ['WeGento\Core\Debug\Caster\MemcachedCaster', 'castMemcached'],

        'Ds\Collection' => ['WeGento\Core\Debug\Caster\DsCaster', 'castCollection'],
        'Ds\Map' => ['WeGento\Core\Debug\Caster\DsCaster', 'castMap'],
        'Ds\Pair' => ['WeGento\Core\Debug\Caster\DsCaster', 'castPair'],
        'WeGento\Core\Debug\Caster\DsPairStub' => ['WeGento\Core\Debug\Caster\DsCaster', 'castPairStub'],

        'CurlHandle' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castCurl'],
        ':curl' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castCurl'],

        ':dba' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castDba'],
        ':dba persistent' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castDba'],
        ':gd' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castGd'],
        ':mysql link' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castMysqlLink'],
        ':pgsql large object' => ['WeGento\Core\Debug\Caster\PgSqlCaster', 'castLargeObject'],
        ':pgsql link' => ['WeGento\Core\Debug\Caster\PgSqlCaster', 'castLink'],
        ':pgsql link persistent' => ['WeGento\Core\Debug\Caster\PgSqlCaster', 'castLink'],
        ':pgsql result' => ['WeGento\Core\Debug\Caster\PgSqlCaster', 'castResult'],
        ':process' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castProcess'],
        ':stream' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castStream'],
        ':OpenSSL X.509' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castOpensslX509'],
        ':persistent stream' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castStream'],
        ':stream-context' => ['WeGento\Core\Debug\Caster\ResourceCaster', 'castStreamContext'],
        ':xml' => ['WeGento\Core\Debug\Caster\XmlResourceCaster', 'castXml'],

        'RdKafka' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castRdKafka'],
        'RdKafka\Conf' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castConf'],
        'RdKafka\KafkaConsumer' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castKafkaConsumer'],
        'RdKafka\Metadata\Broker' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castBrokerMetadata'],
        'RdKafka\Metadata\Collection' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castCollectionMetadata'],
        'RdKafka\Metadata\Partition' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castPartitionMetadata'],
        'RdKafka\Metadata\Topic' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castTopicMetadata'],
        'RdKafka\Message' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castMessage'],
        'RdKafka\Topic' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castTopic'],
        'RdKafka\TopicPartition' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castTopicPartition'],
        'RdKafka\TopicConf' => ['WeGento\Core\Debug\Caster\RdKafkaCaster', 'castTopicConf'],
    ];

    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;

    private $casters = [];
    private $prevErrorHandler;
    private $classInfo = [];
    private $filter = 0;

    /**
     * @param callable[]|null $casters A map of casters
     *
     * @see addCasters
     */
    public function __construct(array $casters = null)
    {
        if (null === $casters) {
            $casters = static::$defaultCasters;
        }
        $this->addCasters($casters);
    }

    /**
     * Adds casters for resources and objects.
     *
     * Maps resources or objects types to a callback.
     * Types are in the key, with a callable caster for value.
     * Resource types are to be prefixed with a `:`,
     * see e.g. static::$defaultCasters.
     *
     * @param callable[] $casters A map of casters
     */
    public function addCasters(array $casters)
    {
        foreach ($casters as $type => $callback) {
            $this->casters[$type][] = $callback;
        }
    }

    /**
     * Sets the maximum number of items to clone past the minimum depth in nested structures.
     */
    public function setMaxItems(int $maxItems)
    {
        $this->maxItems = $maxItems;
    }

    /**
     * Sets the maximum cloned length for strings.
     */
    public function setMaxString(int $maxString)
    {
        $this->maxString = $maxString;
    }

    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     */
    public function setMinDepth(int $minDepth)
    {
        $this->minDepth = $minDepth;
    }

    /**
     * Clones a PHP variable.
     *
     * @param mixed $var    Any PHP variable
     * @param int   $filter A bit field of Caster::EXCLUDE_* constants
     *
     * @return Data The cloned variable represented by a Data object
     */
    public function cloneVar($var, int $filter = 0)
    {
        $this->prevErrorHandler = set_error_handler(function ($type, $msg, $file, $line, $context = []) {
            if (\E_RECOVERABLE_ERROR === $type || \E_USER_ERROR === $type) {
                // Cloner never dies
                throw new \ErrorException($msg, 0, $type, $file, $line);
            }

            if ($this->prevErrorHandler) {
                return ($this->prevErrorHandler)($type, $msg, $file, $line, $context);
            }

            return false;
        });
        $this->filter = $filter;

        if ($gc = gc_enabled()) {
            gc_disable();
        }
        try {
            return new Data($this->doClone($var));
        } finally {
            if ($gc) {
                gc_enable();
            }
            restore_error_handler();
            $this->prevErrorHandler = null;
        }
    }

    /**
     * Effectively clones the PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
     * @return array The cloned variable represented in an array
     */
    abstract protected function doClone($var);

    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The object casted as array
     */
    protected function castObject(Stub $stub, bool $isNested)
    {
        $obj = $stub->value;
        $class = $stub->class;

        if (\PHP_VERSION_ID < 80000 ? "\0" === ($class[15] ?? null) : false !== strpos($class, "@anonymous\0")) {
            $stub->class = get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            list($i, $parents, $hasDebugInfo, $fileInfo) = $this->classInfo[$class];
        } else {
            $i = 2;
            $parents = [$class];
            $hasDebugInfo = method_exists($class, '__debugInfo');

            foreach (class_parents($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            foreach (class_implements($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            $parents[] = '*';

            $r = new \ReflectionClass($class);
            $fileInfo = $r->isInternal() || $r->isSubclassOf(Stub::class) ? [] : [
                'file' => $r->getFileName(),
                'line' => $r->getStartLine(),
            ];

            $this->classInfo[$class] = [$i, $parents, $hasDebugInfo, $fileInfo];
        }

        $stub->attr += $fileInfo;
        $a = Caster::castObject($obj, $class, $hasDebugInfo, $stub->class);

        try {
            while ($i--) {
                if (!empty($this->casters[$p = $parents[$i]])) {
                    foreach ($this->casters[$p] as $callback) {
                        $a = $callback($obj, $a, $stub, $isNested, $this->filter);
                    }
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '').'⚠' => new ThrowingCasterException($e)] + $a;
        }

        return $a;
    }

    /**
     * Casts a resource to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The resource casted as array
     */
    protected function castResource(Stub $stub, bool $isNested)
    {
        $a = [];
        $res = $stub->value;
        $type = $stub->class;

        try {
            if (!empty($this->casters[':'.$type])) {
                foreach ($this->casters[':'.$type] as $callback) {
                    $a = $callback($res, $a, $stub, $isNested, $this->filter);
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '').'⚠' => new ThrowingCasterException($e)] + $a;
        }

        return $a;
    }
}
