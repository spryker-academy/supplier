<?php

namespace Orm\Zed\FileManager\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\FileManager\Persistence\SpyFile as ChildSpyFile;
use Orm\Zed\FileManager\Persistence\SpyFileQuery as ChildSpyFileQuery;
use Orm\Zed\FileManager\Persistence\Map\SpyFileTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModel;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_file` table.
 *
 * @method     ChildSpyFileQuery orderByIdFile($order = Criteria::ASC) Order by the id_file column
 * @method     ChildSpyFileQuery orderByFkFileDirectory($order = Criteria::ASC) Order by the fk_file_directory column
 * @method     ChildSpyFileQuery orderByFileName($order = Criteria::ASC) Order by the file_name column
 * @method     ChildSpyFileQuery orderByFileReference($order = Criteria::ASC) Order by the file_reference column
 * @method     ChildSpyFileQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyFileQuery groupByIdFile() Group by the id_file column
 * @method     ChildSpyFileQuery groupByFkFileDirectory() Group by the fk_file_directory column
 * @method     ChildSpyFileQuery groupByFileName() Group by the file_name column
 * @method     ChildSpyFileQuery groupByFileReference() Group by the file_reference column
 * @method     ChildSpyFileQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyFileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyFileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyFileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyFileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyFileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyFileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyFileQuery leftJoinFileDirectory($relationAlias = null) Adds a LEFT JOIN clause to the query using the FileDirectory relation
 * @method     ChildSpyFileQuery rightJoinFileDirectory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FileDirectory relation
 * @method     ChildSpyFileQuery innerJoinFileDirectory($relationAlias = null) Adds a INNER JOIN clause to the query using the FileDirectory relation
 *
 * @method     ChildSpyFileQuery joinWithFileDirectory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FileDirectory relation
 *
 * @method     ChildSpyFileQuery leftJoinWithFileDirectory() Adds a LEFT JOIN clause and with to the query using the FileDirectory relation
 * @method     ChildSpyFileQuery rightJoinWithFileDirectory() Adds a RIGHT JOIN clause and with to the query using the FileDirectory relation
 * @method     ChildSpyFileQuery innerJoinWithFileDirectory() Adds a INNER JOIN clause and with to the query using the FileDirectory relation
 *
 * @method     ChildSpyFileQuery leftJoinSpyCompanyUserFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyFileQuery rightJoinSpyCompanyUserFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyFileQuery innerJoinSpyCompanyUserFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUserFile relation
 *
 * @method     ChildSpyFileQuery joinWithSpyCompanyUserFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUserFile relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpyCompanyUserFile() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyFileQuery rightJoinWithSpyCompanyUserFile() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyFileQuery innerJoinWithSpyCompanyUserFile() Adds a INNER JOIN clause and with to the query using the SpyCompanyUserFile relation
 *
 * @method     ChildSpyFileQuery leftJoinSpyCompanyBusinessUnitFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyFileQuery rightJoinSpyCompanyBusinessUnitFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyFileQuery innerJoinSpyCompanyBusinessUnitFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
 *
 * @method     ChildSpyFileQuery joinWithSpyCompanyBusinessUnitFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyBusinessUnitFile relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpyCompanyBusinessUnitFile() Adds a LEFT JOIN clause and with to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyFileQuery rightJoinWithSpyCompanyBusinessUnitFile() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyFileQuery innerJoinWithSpyCompanyBusinessUnitFile() Adds a INNER JOIN clause and with to the query using the SpyCompanyBusinessUnitFile relation
 *
 * @method     ChildSpyFileQuery leftJoinSpyFileInfo($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyFileInfo relation
 * @method     ChildSpyFileQuery rightJoinSpyFileInfo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyFileInfo relation
 * @method     ChildSpyFileQuery innerJoinSpyFileInfo($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyFileInfo relation
 *
 * @method     ChildSpyFileQuery joinWithSpyFileInfo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyFileInfo relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpyFileInfo() Adds a LEFT JOIN clause and with to the query using the SpyFileInfo relation
 * @method     ChildSpyFileQuery rightJoinWithSpyFileInfo() Adds a RIGHT JOIN clause and with to the query using the SpyFileInfo relation
 * @method     ChildSpyFileQuery innerJoinWithSpyFileInfo() Adds a INNER JOIN clause and with to the query using the SpyFileInfo relation
 *
 * @method     ChildSpyFileQuery leftJoinSpyFileLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyFileQuery rightJoinSpyFileLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyFileQuery innerJoinSpyFileLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyFileLocalizedAttributes relation
 *
 * @method     ChildSpyFileQuery joinWithSpyFileLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyFileLocalizedAttributes relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpyFileLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyFileQuery rightJoinWithSpyFileLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyFileQuery innerJoinWithSpyFileLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyFileLocalizedAttributes relation
 *
 * @method     ChildSpyFileQuery leftJoinSpySspInquiryFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquiryFile relation
 * @method     ChildSpyFileQuery rightJoinSpySspInquiryFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquiryFile relation
 * @method     ChildSpyFileQuery innerJoinSpySspInquiryFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquiryFile relation
 *
 * @method     ChildSpyFileQuery joinWithSpySspInquiryFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquiryFile relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpySspInquiryFile() Adds a LEFT JOIN clause and with to the query using the SpySspInquiryFile relation
 * @method     ChildSpyFileQuery rightJoinWithSpySspInquiryFile() Adds a RIGHT JOIN clause and with to the query using the SpySspInquiryFile relation
 * @method     ChildSpyFileQuery innerJoinWithSpySspInquiryFile() Adds a INNER JOIN clause and with to the query using the SpySspInquiryFile relation
 *
 * @method     ChildSpyFileQuery leftJoinSpySspAssetFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspAssetFile relation
 * @method     ChildSpyFileQuery rightJoinSpySspAssetFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspAssetFile relation
 * @method     ChildSpyFileQuery innerJoinSpySspAssetFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspAssetFile relation
 *
 * @method     ChildSpyFileQuery joinWithSpySspAssetFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspAssetFile relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpySspAssetFile() Adds a LEFT JOIN clause and with to the query using the SpySspAssetFile relation
 * @method     ChildSpyFileQuery rightJoinWithSpySspAssetFile() Adds a RIGHT JOIN clause and with to the query using the SpySspAssetFile relation
 * @method     ChildSpyFileQuery innerJoinWithSpySspAssetFile() Adds a INNER JOIN clause and with to the query using the SpySspAssetFile relation
 *
 * @method     ChildSpyFileQuery leftJoinSpySspAsset($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspAsset relation
 * @method     ChildSpyFileQuery rightJoinSpySspAsset($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspAsset relation
 * @method     ChildSpyFileQuery innerJoinSpySspAsset($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspAsset relation
 *
 * @method     ChildSpyFileQuery joinWithSpySspAsset($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspAsset relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpySspAsset() Adds a LEFT JOIN clause and with to the query using the SpySspAsset relation
 * @method     ChildSpyFileQuery rightJoinWithSpySspAsset() Adds a RIGHT JOIN clause and with to the query using the SpySspAsset relation
 * @method     ChildSpyFileQuery innerJoinWithSpySspAsset() Adds a INNER JOIN clause and with to the query using the SpySspAsset relation
 *
 * @method     ChildSpyFileQuery leftJoinSpySspModel($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspModel relation
 * @method     ChildSpyFileQuery rightJoinSpySspModel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspModel relation
 * @method     ChildSpyFileQuery innerJoinSpySspModel($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspModel relation
 *
 * @method     ChildSpyFileQuery joinWithSpySspModel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspModel relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpySspModel() Adds a LEFT JOIN clause and with to the query using the SpySspModel relation
 * @method     ChildSpyFileQuery rightJoinWithSpySspModel() Adds a RIGHT JOIN clause and with to the query using the SpySspModel relation
 * @method     ChildSpyFileQuery innerJoinWithSpySspModel() Adds a INNER JOIN clause and with to the query using the SpySspModel relation
 *
 * @method     ChildSpyFileQuery leftJoinSpySspModelToFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspModelToFile relation
 * @method     ChildSpyFileQuery rightJoinSpySspModelToFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspModelToFile relation
 * @method     ChildSpyFileQuery innerJoinSpySspModelToFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspModelToFile relation
 *
 * @method     ChildSpyFileQuery joinWithSpySspModelToFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspModelToFile relation
 *
 * @method     ChildSpyFileQuery leftJoinWithSpySspModelToFile() Adds a LEFT JOIN clause and with to the query using the SpySspModelToFile relation
 * @method     ChildSpyFileQuery rightJoinWithSpySspModelToFile() Adds a RIGHT JOIN clause and with to the query using the SpySspModelToFile relation
 * @method     ChildSpyFileQuery innerJoinWithSpySspModelToFile() Adds a INNER JOIN clause and with to the query using the SpySspModelToFile relation
 *
 * @method     \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery|\Orm\Zed\FileManager\Persistence\SpyFileInfoQuery|\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyFile|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyFile matching the query
 * @method     ChildSpyFile findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyFile matching the query, or a new ChildSpyFile object populated from the query conditions when no match is found
 *
 * @method     ChildSpyFile|null findOneByIdFile(int $id_file) Return the first ChildSpyFile filtered by the id_file column
 * @method     ChildSpyFile|null findOneByFkFileDirectory(int $fk_file_directory) Return the first ChildSpyFile filtered by the fk_file_directory column
 * @method     ChildSpyFile|null findOneByFileName(string $file_name) Return the first ChildSpyFile filtered by the file_name column
 * @method     ChildSpyFile|null findOneByFileReference(string $file_reference) Return the first ChildSpyFile filtered by the file_reference column
 * @method     ChildSpyFile|null findOneByUuid(string $uuid) Return the first ChildSpyFile filtered by the uuid column
 *
 * @method     ChildSpyFile requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyFile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFile requireOne(?ConnectionInterface $con = null) Return the first ChildSpyFile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyFile requireOneByIdFile(int $id_file) Return the first ChildSpyFile filtered by the id_file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFile requireOneByFkFileDirectory(int $fk_file_directory) Return the first ChildSpyFile filtered by the fk_file_directory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFile requireOneByFileName(string $file_name) Return the first ChildSpyFile filtered by the file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFile requireOneByFileReference(string $file_reference) Return the first ChildSpyFile filtered by the file_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFile requireOneByUuid(string $uuid) Return the first ChildSpyFile filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyFile[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyFile objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyFile> find(?ConnectionInterface $con = null) Return ChildSpyFile objects based on current ModelCriteria
 *
 * @method     ChildSpyFile[]|Collection findByIdFile(int|array<int> $id_file) Return ChildSpyFile objects filtered by the id_file column
 * @psalm-method Collection&\Traversable<ChildSpyFile> findByIdFile(int|array<int> $id_file) Return ChildSpyFile objects filtered by the id_file column
 * @method     ChildSpyFile[]|Collection findByFkFileDirectory(int|array<int> $fk_file_directory) Return ChildSpyFile objects filtered by the fk_file_directory column
 * @psalm-method Collection&\Traversable<ChildSpyFile> findByFkFileDirectory(int|array<int> $fk_file_directory) Return ChildSpyFile objects filtered by the fk_file_directory column
 * @method     ChildSpyFile[]|Collection findByFileName(string|array<string> $file_name) Return ChildSpyFile objects filtered by the file_name column
 * @psalm-method Collection&\Traversable<ChildSpyFile> findByFileName(string|array<string> $file_name) Return ChildSpyFile objects filtered by the file_name column
 * @method     ChildSpyFile[]|Collection findByFileReference(string|array<string> $file_reference) Return ChildSpyFile objects filtered by the file_reference column
 * @psalm-method Collection&\Traversable<ChildSpyFile> findByFileReference(string|array<string> $file_reference) Return ChildSpyFile objects filtered by the file_reference column
 * @method     ChildSpyFile[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyFile objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyFile> findByUuid(string|array<string> $uuid) Return ChildSpyFile objects filtered by the uuid column
 *
 * @method     ChildSpyFile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyFile> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyFileQuery extends ModelCriteria
{

    /**
     * @var bool
     */
    protected $isForUpdateEnabled = false;

    /**
     * @deprecated Use {@link \Propel\Runtime\ActiveQuery\Criteria::lockForUpdate()} instead.
     *
     * @param bool $isForUpdateEnabled
     *
     * @return $this The primary criteria object
     */
    public function forUpdate($isForUpdateEnabled)
    {
        $this->isForUpdateEnabled = $isForUpdateEnabled;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function createSelectSql(&$params): string
    {
        $sql = parent::createSelectSql($params);
        if ($this->isForUpdateEnabled) {
            $sql .= ' FOR UPDATE';
        }

        return $sql;
    }

    /**
     * Clear the conditions to allow the reuse of the query object.
     * The ModelCriteria's Model and alias 'all the properties set by construct) will remain.
     *
     * @return $this The primary criteria object
     */
    public function clear()
    {
        parent::clear();

        $this->isSelfSelected = false;
        $this->forUpdate(false);

        return $this;
    }


    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postUpdate(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Propel\Runtime\ActiveRecord\ActiveRecordInterface[]|mixed the list of results, formatted by the current formatter
     */
    public function find(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::find($con);
    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object.
     *
     * Does not work with ->with()s containing one-to-many relations.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::findOne($con);
    }

    /**
     * Issue an existence check on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return bool column existence
     */
    public function exists(?ConnectionInterface $con = null): bool
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::exists($con);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function configureSelectColumns(): void
    {
        if (!$this->select) {
            return;
        }

        if ($this->formatter === null) {
            $this->setFormatter(new TypeAwareSimpleArrayFormatter());
        }

        parent::configureSelectColumns();
     }
        protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\FileManager\Persistence\Base\SpyFileQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyFileQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyFileQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyFileQuery) {
            return $criteria;
        }
        $query = new ChildSpyFileQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpyFile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SpyFileTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSpyFile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_file, fk_file_directory, file_name, file_reference, uuid FROM spy_file WHERE id_file = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpyFile $obj */
            $obj = new ChildSpyFile();
            $obj->hydrate($row);
            SpyFileTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSpyFile|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idFile Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdFile_Between(array $idFile)
    {
        return $this->filterByIdFile($idFile, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idFiles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdFile_In(array $idFiles)
    {
        return $this->filterByIdFile($idFiles, Criteria::IN);
    }

    /**
     * Filter the query on the id_file column
     *
     * Example usage:
     * <code>
     * $query->filterByIdFile(1234); // WHERE id_file = 1234
     * $query->filterByIdFile(array(12, 34), Criteria::IN); // WHERE id_file IN (12, 34)
     * $query->filterByIdFile(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_file > 12
     * </code>
     *
     * @param     mixed $idFile The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdFile($idFile = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idFile)) {
            $useMinMax = false;
            if (isset($idFile['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $idFile['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idFile['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $idFile['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idFile of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $idFile, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkFileDirectory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkFileDirectory_Between(array $fkFileDirectory)
    {
        return $this->filterByFkFileDirectory($fkFileDirectory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkFileDirectorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkFileDirectory_In(array $fkFileDirectorys)
    {
        return $this->filterByFkFileDirectory($fkFileDirectorys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_file_directory column
     *
     * Example usage:
     * <code>
     * $query->filterByFkFileDirectory(1234); // WHERE fk_file_directory = 1234
     * $query->filterByFkFileDirectory(array(12, 34), Criteria::IN); // WHERE fk_file_directory IN (12, 34)
     * $query->filterByFkFileDirectory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_file_directory > 12
     * </code>
     *
     * @see       filterByFileDirectory()
     *
     * @param     mixed $fkFileDirectory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkFileDirectory($fkFileDirectory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkFileDirectory)) {
            $useMinMax = false;
            if (isset($fkFileDirectory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileTableMap::COL_FK_FILE_DIRECTORY, $fkFileDirectory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkFileDirectory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileTableMap::COL_FK_FILE_DIRECTORY, $fkFileDirectory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkFileDirectory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyFileTableMap::COL_FK_FILE_DIRECTORY, $fkFileDirectory, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fileNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileName_In(array $fileNames)
    {
        return $this->filterByFileName($fileNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $fileName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileName_Like($fileName)
    {
        return $this->filterByFileName($fileName, Criteria::LIKE);
    }

    /**
     * Filter the query on the file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFileName('fooValue');   // WHERE file_name = 'fooValue'
     * $query->filterByFileName('%fooValue%', Criteria::LIKE); // WHERE file_name LIKE '%fooValue%'
     * $query->filterByFileName([1, 'foo'], Criteria::IN); // WHERE file_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $fileName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFileName($fileName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $fileName = str_replace('*', '%', $fileName);
        }

        if (is_array($fileName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$fileName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyFileTableMap::COL_FILE_NAME, $fileName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fileReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileReference_In(array $fileReferences)
    {
        return $this->filterByFileReference($fileReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $fileReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileReference_Like($fileReference)
    {
        return $this->filterByFileReference($fileReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the file_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByFileReference('fooValue');   // WHERE file_reference = 'fooValue'
     * $query->filterByFileReference('%fooValue%', Criteria::LIKE); // WHERE file_reference LIKE '%fooValue%'
     * $query->filterByFileReference([1, 'foo'], Criteria::IN); // WHERE file_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $fileReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFileReference($fileReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $fileReference = str_replace('*', '%', $fileReference);
        }

        if (is_array($fileReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$fileReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyFileTableMap::COL_FILE_REFERENCE, $fileReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyFileTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileDirectory object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileDirectory|ObjectCollection $spyFileDirectory The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileDirectory($spyFileDirectory, ?string $comparison = null)
    {
        if ($spyFileDirectory instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectory) {
            return $this
                ->addUsingAlias(SpyFileTableMap::COL_FK_FILE_DIRECTORY, $spyFileDirectory->getIdFileDirectory(), $comparison);
        } elseif ($spyFileDirectory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyFileTableMap::COL_FK_FILE_DIRECTORY, $spyFileDirectory->toKeyValue('PrimaryKey', 'IdFileDirectory'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByFileDirectory() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileDirectory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FileDirectory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFileDirectory(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FileDirectory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FileDirectory');
        }

        return $this;
    }

    /**
     * Use the FileDirectory relation SpyFileDirectory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery A secondary query class using the current class as primary query
     */
    public function useFileDirectoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFileDirectory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FileDirectory', '\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery');
    }

    /**
     * Use the FileDirectory relation SpyFileDirectory object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery):\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFileDirectoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFileDirectoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the FileDirectory relation to the SpyFileDirectory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the EXISTS statement
     */
    public function useFileDirectoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useExistsQuery('FileDirectory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the FileDirectory relation to the SpyFileDirectory table for a NOT EXISTS query.
     *
     * @see useFileDirectoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useFileDirectoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useExistsQuery('FileDirectory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the FileDirectory relation to the SpyFileDirectory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the IN statement
     */
    public function useInFileDirectoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useInQuery('FileDirectory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the FileDirectory relation to the SpyFileDirectory table for a NOT IN query.
     *
     * @see useFileDirectoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInFileDirectoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useInQuery('FileDirectory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile|ObjectCollection $spyCompanyUserFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyUserFile($spyCompanyUserFile, ?string $comparison = null)
    {
        if ($spyCompanyUserFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spyCompanyUserFile->getFkFile(), $comparison);

            return $this;
        } elseif ($spyCompanyUserFile instanceof ObjectCollection) {
            $this
                ->useSpyCompanyUserFileQuery()
                ->filterByPrimaryKeys($spyCompanyUserFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUserFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUserFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUserFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUserFile');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyCompanyUserFile');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUserFile relation SpyCompanyUserFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUserFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyUserFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUserFile', '\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery');
    }

    /**
     * Use the SpyCompanyUserFile relation SpyCompanyUserFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUserFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUserFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUserFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useExistsQuery('SpyCompanyUserFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUserFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUserFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useExistsQuery('SpyCompanyUserFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUserFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useInQuery('SpyCompanyUserFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for a NOT IN query.
     *
     * @see useSpyCompanyUserFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUserFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useInQuery('SpyCompanyUserFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile|ObjectCollection $spyCompanyBusinessUnitFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyBusinessUnitFile($spyCompanyBusinessUnitFile, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnitFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spyCompanyBusinessUnitFile->getFkFile(), $comparison);

            return $this;
        } elseif ($spyCompanyBusinessUnitFile instanceof ObjectCollection) {
            $this
                ->useSpyCompanyBusinessUnitFileQuery()
                ->filterByPrimaryKeys($spyCompanyBusinessUnitFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyBusinessUnitFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyBusinessUnitFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyBusinessUnitFile');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyCompanyBusinessUnitFile');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyBusinessUnitFile relation SpyCompanyBusinessUnitFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyBusinessUnitFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyBusinessUnitFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyBusinessUnitFile', '\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery');
    }

    /**
     * Use the SpyCompanyBusinessUnitFile relation SpyCompanyBusinessUnitFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyBusinessUnitFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyBusinessUnitFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyBusinessUnitFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useExistsQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for a NOT EXISTS query.
     *
     * @see useSpyCompanyBusinessUnitFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyBusinessUnitFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useExistsQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyBusinessUnitFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useInQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for a NOT IN query.
     *
     * @see useSpyCompanyBusinessUnitFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyBusinessUnitFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useInQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileInfo object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileInfo|ObjectCollection $spyFileInfo the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyFileInfo($spyFileInfo, ?string $comparison = null)
    {
        if ($spyFileInfo instanceof \Orm\Zed\FileManager\Persistence\SpyFileInfo) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spyFileInfo->getFkFile(), $comparison);

            return $this;
        } elseif ($spyFileInfo instanceof ObjectCollection) {
            $this
                ->useSpyFileInfoQuery()
                ->filterByPrimaryKeys($spyFileInfo->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyFileInfo() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileInfo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyFileInfo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyFileInfo(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyFileInfo');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyFileInfo');
        }

        return $this;
    }

    /**
     * Use the SpyFileInfo relation SpyFileInfo object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery A secondary query class using the current class as primary query
     */
    public function useSpyFileInfoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyFileInfo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyFileInfo', '\Orm\Zed\FileManager\Persistence\SpyFileInfoQuery');
    }

    /**
     * Use the SpyFileInfo relation SpyFileInfo object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileInfoQuery):\Orm\Zed\FileManager\Persistence\SpyFileInfoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyFileInfoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyFileInfoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyFileInfo table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery The inner query object of the EXISTS statement
     */
    public function useSpyFileInfoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery */
        $q = $this->useExistsQuery('SpyFileInfo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyFileInfo table for a NOT EXISTS query.
     *
     * @see useSpyFileInfoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyFileInfoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery */
        $q = $this->useExistsQuery('SpyFileInfo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyFileInfo table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery The inner query object of the IN statement
     */
    public function useInSpyFileInfoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery */
        $q = $this->useInQuery('SpyFileInfo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyFileInfo table for a NOT IN query.
     *
     * @see useSpyFileInfoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyFileInfoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileInfoQuery */
        $q = $this->useInQuery('SpyFileInfo', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes|ObjectCollection $spyFileLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyFileLocalizedAttributes($spyFileLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyFileLocalizedAttributes instanceof \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spyFileLocalizedAttributes->getFkFile(), $comparison);

            return $this;
        } elseif ($spyFileLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyFileLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyFileLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyFileLocalizedAttributes() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyFileLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyFileLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyFileLocalizedAttributes');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyFileLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyFileLocalizedAttributes relation SpyFileLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyFileLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyFileLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyFileLocalizedAttributes', '\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery');
    }

    /**
     * Use the SpyFileLocalizedAttributes relation SpyFileLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery):\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyFileLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyFileLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyFileLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyFileLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyFileLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyFileLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyFileLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyFileLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile|ObjectCollection $spySspInquiryFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquiryFile($spySspInquiryFile, ?string $comparison = null)
    {
        if ($spySspInquiryFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spySspInquiryFile->getFkFile(), $comparison);

            return $this;
        } elseif ($spySspInquiryFile instanceof ObjectCollection) {
            $this
                ->useSpySspInquiryFileQuery()
                ->filterByPrimaryKeys($spySspInquiryFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquiryFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquiryFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquiryFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquiryFile');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySspInquiryFile');
        }

        return $this;
    }

    /**
     * Use the SpySspInquiryFile relation SpySspInquiryFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquiryFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspInquiryFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquiryFile', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery');
    }

    /**
     * Use the SpySspInquiryFile relation SpySspInquiryFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquiryFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquiryFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquiryFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquiryFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useExistsQuery('SpySspInquiryFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquiryFile table for a NOT EXISTS query.
     *
     * @see useSpySspInquiryFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquiryFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useExistsQuery('SpySspInquiryFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquiryFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the IN statement
     */
    public function useInSpySspInquiryFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useInQuery('SpySspInquiryFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquiryFile table for a NOT IN query.
     *
     * @see useSpySspInquiryFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquiryFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useInQuery('SpySspInquiryFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile|ObjectCollection $spySspAssetFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspAssetFile($spySspAssetFile, ?string $comparison = null)
    {
        if ($spySspAssetFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spySspAssetFile->getFkFile(), $comparison);

            return $this;
        } elseif ($spySspAssetFile instanceof ObjectCollection) {
            $this
                ->useSpySspAssetFileQuery()
                ->filterByPrimaryKeys($spySspAssetFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspAssetFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspAssetFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspAssetFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspAssetFile');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySspAssetFile');
        }

        return $this;
    }

    /**
     * Use the SpySspAssetFile relation SpySspAssetFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery A secondary query class using the current class as primary query
     */
    public function useSpySspAssetFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspAssetFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspAssetFile', '\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery');
    }

    /**
     * Use the SpySspAssetFile relation SpySspAssetFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspAssetFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspAssetFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspAssetFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery The inner query object of the EXISTS statement
     */
    public function useSpySspAssetFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery */
        $q = $this->useExistsQuery('SpySspAssetFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspAssetFile table for a NOT EXISTS query.
     *
     * @see useSpySspAssetFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspAssetFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery */
        $q = $this->useExistsQuery('SpySspAssetFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspAssetFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery The inner query object of the IN statement
     */
    public function useInSpySspAssetFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery */
        $q = $this->useInQuery('SpySspAssetFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspAssetFile table for a NOT IN query.
     *
     * @see useSpySspAssetFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspAssetFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetFileQuery */
        $q = $this->useInQuery('SpySspAssetFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset|ObjectCollection $spySspAsset the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspAsset($spySspAsset, ?string $comparison = null)
    {
        if ($spySspAsset instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spySspAsset->getFkImageFile(), $comparison);

            return $this;
        } elseif ($spySspAsset instanceof ObjectCollection) {
            $this
                ->useSpySspAssetQuery()
                ->filterByPrimaryKeys($spySspAsset->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspAsset() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspAsset relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspAsset(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspAsset');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySspAsset');
        }

        return $this;
    }

    /**
     * Use the SpySspAsset relation SpySspAsset object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery A secondary query class using the current class as primary query
     */
    public function useSpySspAssetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySspAsset($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspAsset', '\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery');
    }

    /**
     * Use the SpySspAsset relation SpySspAsset object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspAssetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySspAssetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspAsset table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the EXISTS statement
     */
    public function useSpySspAssetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useExistsQuery('SpySspAsset', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspAsset table for a NOT EXISTS query.
     *
     * @see useSpySspAssetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspAssetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useExistsQuery('SpySspAsset', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspAsset table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the IN statement
     */
    public function useInSpySspAssetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useInQuery('SpySspAsset', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspAsset table for a NOT IN query.
     *
     * @see useSpySspAssetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspAssetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useInQuery('SpySspAsset', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspModel object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspModel|ObjectCollection $spySspModel the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspModel($spySspModel, ?string $comparison = null)
    {
        if ($spySspModel instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspModel) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spySspModel->getFkImageFile(), $comparison);

            return $this;
        } elseif ($spySspModel instanceof ObjectCollection) {
            $this
                ->useSpySspModelQuery()
                ->filterByPrimaryKeys($spySspModel->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspModel() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspModel or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspModel relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspModel(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspModel');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySspModel');
        }

        return $this;
    }

    /**
     * Use the SpySspModel relation SpySspModel object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery A secondary query class using the current class as primary query
     */
    public function useSpySspModelQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySspModel($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspModel', '\Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery');
    }

    /**
     * Use the SpySspModel relation SpySspModel object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspModelQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySspModelQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspModel table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery The inner query object of the EXISTS statement
     */
    public function useSpySspModelExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery */
        $q = $this->useExistsQuery('SpySspModel', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspModel table for a NOT EXISTS query.
     *
     * @see useSpySspModelExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspModelNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery */
        $q = $this->useExistsQuery('SpySspModel', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspModel table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery The inner query object of the IN statement
     */
    public function useInSpySspModelQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery */
        $q = $this->useInQuery('SpySspModel', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspModel table for a NOT IN query.
     *
     * @see useSpySspModelInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspModelQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery */
        $q = $this->useInQuery('SpySspModel', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile|ObjectCollection $spySspModelToFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspModelToFile($spySspModelToFile, ?string $comparison = null)
    {
        if ($spySspModelToFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile) {
            $this
                ->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spySspModelToFile->getFkFile(), $comparison);

            return $this;
        } elseif ($spySspModelToFile instanceof ObjectCollection) {
            $this
                ->useSpySspModelToFileQuery()
                ->filterByPrimaryKeys($spySspModelToFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspModelToFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspModelToFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspModelToFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspModelToFile');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpySspModelToFile');
        }

        return $this;
    }

    /**
     * Use the SpySspModelToFile relation SpySspModelToFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery A secondary query class using the current class as primary query
     */
    public function useSpySspModelToFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspModelToFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspModelToFile', '\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery');
    }

    /**
     * Use the SpySspModelToFile relation SpySspModelToFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspModelToFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspModelToFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspModelToFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the EXISTS statement
     */
    public function useSpySspModelToFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useExistsQuery('SpySspModelToFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToFile table for a NOT EXISTS query.
     *
     * @see useSpySspModelToFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspModelToFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useExistsQuery('SpySspModelToFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspModelToFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the IN statement
     */
    public function useInSpySspModelToFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useInQuery('SpySspModelToFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToFile table for a NOT IN query.
     *
     * @see useSpySspModelToFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspModelToFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useInQuery('SpySspModelToFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyFile $spyFile Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyFile = null)
    {
        if ($spyFile) {
            $this->addUsingAlias(SpyFileTableMap::COL_ID_FILE, $spyFile->getIdFile(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every SELECT statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     */
    protected function basePreSelect(ConnectionInterface $con): void
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnSelectQuery($this);
            }
        }


        $this->preSelect($con);
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     * @return int|null
     */
    protected function basePreDelete(ConnectionInterface $con): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnDeleteQuery($this);
            }
        }


        return $this->preDelete($con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param array $values The associative array of columns and values for the update
     * @param ConnectionInterface $con The connection object used by the query
     * @param bool $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     *
     * @return int|null
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnUpdateQuery($this);
            }
        }


        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Deletes all rows from the spy_file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyFileTableMap::clearInstancePool();
            SpyFileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyFileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyFileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyFileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
    // phpcs:ignoreFile
    /**
     * @return \Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory
     */
    protected function getPersistenceFactory(): \Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory
    {
        return (new \Spryker\Zed\Kernel\ClassResolver\Persistence\PersistenceFactoryResolver())
            ->resolve(\Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory::class);
    }
    // phpcs:ignoreFile
    /**
     * @return bool
     */
    protected function isSegmentQuery(): bool
    {
        $segmentTableTemplate = sprintf(
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::CONNECTOR_CLASS_TEMPLATE,
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::ENTITY_PREFIX_DEFAULT,
            ''
        );

        return strpos($this->getModelShortName(), $segmentTableTemplate) === 0;
    }

}
