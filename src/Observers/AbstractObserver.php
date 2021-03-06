<?php

/**
 * TechDivision\Import\Observers\AbstractObserver
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Observers;

use TechDivision\Import\RowTrait;
use TechDivision\Import\Utils\ScopeKeys;
use TechDivision\Import\Utils\LoggerKeys;
use TechDivision\Import\Utils\EntityStatus;
use TechDivision\Import\Subjects\SubjectInterface;

/**
 * An abstract observer implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
abstract class AbstractObserver implements ObserverInterface
{

    /**
     * The trait that provides row handling functionality.
     *
     * @var TechDivision\Import\RowTrait
     */
    use RowTrait;

    /**
     * The obeserver's subject instance.
     *
     * @var \TechDivision\Import\Subjects\SubjectInterface
     */
    protected $subject;

    /**
     * Set's the obeserver's subject instance to initialize the observer with.
     *
     * @param \TechDivision\Import\Subjects\SubjectInterface $subject The observer's subject
     *
     * @return void
     */
    protected function setSubject(SubjectInterface $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Return's the observer's subject instance.
     *
     * @return object The observer's subject instance
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Initialize's and return's a new entity with the status 'create'.
     *
     * @param array $attr The attributes to merge into the new entity
     *
     * @return array The initialized entity
     */
    protected function initializeEntity(array $attr = array())
    {
        return array_merge(array(EntityStatus::MEMBER_NAME => EntityStatus::STATUS_CREATE), $attr);
    }

    /**
     * Merge's and return's the entity with the passed attributes and set's the
     * status to 'update'.
     *
     * @param array $entity The entity to merge the attributes into
     * @param array $attr   The attributes to be merged
     *
     * @return array The merged entity
     */
    protected function mergeEntity(array $entity, array $attr)
    {
        return array_merge($entity, $attr, array(EntityStatus::MEMBER_NAME => EntityStatus::STATUS_UPDATE));
    }

    /**
     * Set's the array containing header row.
     *
     * @param array $headers The array with the header row
     *
     * @return void
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function setHeaders(array $headers)
    {
        $this->getSubject()->setHeaders($headers);
    }

    /**
     * Return's the array containing header row.
     *
     * @return array The array with the header row
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getHeaders()
    {
        return $this->getSubject()->getHeaders();
    }

    /**
     * Return's the RegistryProcessor instance to handle the running threads.
     *
     * @return \TechDivision\Import\Services\RegistryProcessorInterface The registry processor instance
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getRegistryProcessor()
    {
        return $this->getSubject()->getRegistryProcessor();
    }

    /**
     * Append's the exception suffix containing filename and line number to the
     * passed message. If no message has been passed, only the suffix will be
     * returned
     *
     * @param string|null $message    The message to append the exception suffix to
     * @param string|null $filename   The filename used to create the suffix
     * @param string|null $lineNumber The line number used to create the suffx
     *
     * @return string The message with the appended exception suffix
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function appendExceptionSuffix($message = null, $filename = null, $lineNumber = null)
    {
        return $this->getSubject()->appendExceptionSuffix($message, $filename, $lineNumber);
    }

    /**
     * Wraps the passed exeception into a new one by trying to resolve the original filname,
     * line number and column name and use it for a detailed exception message.
     *
     * @param string     $columnName The column name that should be resolved
     * @param \Exception $parent     The exception we want to wrap
     * @param string     $className  The class name of the exception type we want to wrap the parent one
     *
     * @return \Exception the wrapped exception
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function wrapException(
        $columnName,
        \Exception $parent = null,
        $className = '\TechDivision\Import\Exceptions\WrappedColumnException'
    ) {
        return $this->getSubject()->wrapException($columnName, $parent, $className);
    }

    /**
     * Queries whether or not debug mode is enabled or not, default is TRUE.
     *
     * @return boolean TRUE if debug mode is enabled, else FALSE
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function isDebugMode()
    {
        return $this->getSubject()->isDebugMode();
    }

    /**
     * Stop's observer execution on the actual row.
     *
     * @return void
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function skipRow()
    {
        $this->getSubject()->skipRow();
    }

    /**
     * Return's the name of the file to import.
     *
     * @return string The filename
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getFilename()
    {
        return $this->getSubject()->getFilename();
    }

    /**
     * Return's the actual line number.
     *
     * @return integer The line number
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getLineNumber()
    {
        return $this->getSubject()->getLineNumber();
    }

    /**
     * Return's the logger with the passed name, by default the system logger.
     *
     * @param string $name The name of the requested system logger
     *
     * @return \Psr\Log\LoggerInterface The logger instance
     * @throws \Exception Is thrown, if the requested logger is NOT available
     *
     * @codeCoverageIgnore
     */
    protected function getSystemLogger($name = LoggerKeys::SYSTEM)
    {
        return $this->getSubject()->getSystemLogger($name);
    }

    /**
     * Return's the array with the system logger instances.
     *
     * @return array The logger instance
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getSystemLoggers()
    {
        return $this->getSubject()->getSystemLoggers();
    }

    /**
     * Return's the multiple field delimiter character to use, default value is comma (,).
     *
     * @return string The multiple field delimiter character
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getMultipleFieldDelimiter()
    {
        return $this->getSubject()->getMultipleFieldDelimiter();
    }

    /**
     * Return's the multiple value delimiter character to use, default value is comma (|).
     *
     * @return string The multiple value delimiter character
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getMultipleValueDelimiter()
    {
        return $this->getSubject()->getMultipleValueDelimiter();
    }

    /**
     * Queries whether or not the header with the passed name is available.
     *
     * @param string $name The header name to query
     *
     * @return boolean TRUE if the header is available, else FALSE
     *
     * @codeCoverageIgnore
     */
    public function hasHeader($name)
    {
        return $this->getSubject()->hasHeader($name);
    }

    /**
     * Return's the header value for the passed name.
     *
     * @param string $name The name of the header to return the value for
     *
     * @return mixed The header value
     * @throws \InvalidArgumentException Is thrown, if the header with the passed name is NOT available
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getHeader($name)
    {
        return $this->getSubject()->getHeader($name);
    }

    /**
     * Add's the header with the passed name and position, if not NULL.
     *
     * @param string $name The header name to add
     *
     * @return integer The new headers position
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function addHeader($name)
    {
        return $this->getSubject()->addHeader($name);
    }

    /**
     * Return's the ID of the product that has been created recently.
     *
     * @return string The entity Id
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getLastEntityId()
    {
        return $this->getSubject()->getLastEntityId();
    }

    /**
     * Return's the source date format to use.
     *
     * @return string The source date format
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getSourceDateFormat()
    {
        return $this->getSubject()->getSourceDateFormat();
    }

    /**
     * Cast's the passed value based on the backend type information.
     *
     * @param string $backendType The backend type to cast to
     * @param mixed  $value       The value to be casted
     *
     * @return mixed The casted value
     *
     * @codeCoverageIgnore
     */
    public function castValueByBackendType($backendType, $value)
    {
        return $this->getSubject()->castValueByBackendType($backendType, $value);
    }

    /**
     * Set's the store view code the create the product/attributes for.
     *
     * @param string $storeViewCode The store view code
     *
     * @return void
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function setStoreViewCode($storeViewCode)
    {
        $this->getSubject()->setStoreViewCode($storeViewCode);
    }

    /**
     * Return's the store view code the create the product/attributes for.
     *
     * @param string|null $default The default value to return, if the store view code has not been set
     *
     * @return string The store view code
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getStoreViewCode($default = null)
    {
        return $this->getSubject()->getStoreViewCode($default);
    }

    /**
     * Prepare's the store view code in the subject.
     *
     * @return void
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function prepareStoreViewCode()
    {
        $this->getSubject()->prepareStoreViewCode();
    }

    /**
     * Return's the store ID of the store with the passed store view code
     *
     * @param string $storeViewCode The store view code to return the store ID for
     *
     * @return integer The ID of the store with the passed ID
     * @throws \Exception Is thrown, if the store with the actual code is not available
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getStoreId($storeViewCode)
    {
        return $this->getSubject()->getStoreId($storeViewCode);
    }

    /**
     * Return's the store ID of the actual row, or of the default store
     * if no store view code is set in the CSV file.
     *
     * @param string|null $default The default store view code to use, if no store view code is set in the CSV file
     *
     * @return integer The ID of the actual store
     * @throws \Exception Is thrown, if the store with the actual code is not available
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getRowStoreId($default = null)
    {
        return $this->getSubject()->getRowStoreId($default);
    }

    /**
     * Tries to format the passed value to a valid date with format 'Y-m-d H:i:s'.
     * If the passed value is NOT a valid date, NULL will be returned.
     *
     * @param string|null $value The value to format
     *
     * @return string The formatted date
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function formatDate($value)
    {
        return $this->getSubject()->formatDate($value);
    }

    /**
     * Extracts the elements of the passed value by exploding them
     * with the also passed delimiter.
     *
     * @param string      $value     The value to extract
     * @param string|null $delimiter The delimiter used to extrace the elements
     *
     * @return array The exploded values
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function explode($value, $delimiter = null)
    {
        return $this->getSubject()->explode($value, $delimiter);
    }

    /**
     * Return's the Magento configuration value.
     *
     * @param string  $path    The Magento path of the requested configuration value
     * @param mixed   $default The default value that has to be returned, if the requested configuration value is not set
     * @param string  $scope   The scope the configuration value has been set
     * @param integer $scopeId The scope ID the configuration value has been set
     *
     * @return mixed The configuration value
     * @throws \Exception Is thrown, if nor a value can be found or a default value has been passed
     * @deprecated Will be removed with version 1.0.0, use subject method instead
     *
     * @codeCoverageIgnore
     */
    protected function getCoreConfigData($path, $default = null, $scope = ScopeKeys::SCOPE_DEFAULT, $scopeId = 0)
    {
        return $this->getSubject()->getCoreConfigData($path, $default, $scope, $scopeId);
    }
}
