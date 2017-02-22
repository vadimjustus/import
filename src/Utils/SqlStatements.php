<?php

/**
 * TechDivision\Import\Utils\SqlStatements
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

namespace TechDivision\Import\Utils;

/**
 * Utility class with the SQL statements to use.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
class SqlStatements
{

    /**
     * This is a utility class, so protect it against direct
     * instantiation.
     */
    private function __construct()
    {
    }

    /**
     * This is a utility class, so protect it against cloning.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * The SQL statement to load all available categories.
     *
     * @var string
     */
    const CATEGORIES = 'SELECT t0.*,
                               (SELECT `value`
                                  FROM eav_attribute t1, catalog_category_entity_varchar t2
                                 WHERE t1.attribute_code = \'name\'
                                   AND t1.entity_type_id = 3
                                   AND t2.attribute_id = t1.attribute_id
                                   AND t2.store_id = 0
                                   AND t2.entity_id = t0.entity_id) AS name,
                               (SELECT `value`
                                  FROM eav_attribute t1, catalog_category_entity_varchar t2
                                 WHERE t1.attribute_code = \'url_path\'
                                   AND t1.entity_type_id = 3
                                   AND t2.attribute_id = t1.attribute_id
                                   AND t2.store_id = 0
                                   AND t2.entity_id = t0.entity_id) AS url_path
                          FROM catalog_category_entity AS t0';

    /**
     * The SQL statement to load the root categories.
     *
     * @var string
     */
    const ROOT_CATEGORIES = 'SELECT t2.code, t0.*
                               FROM catalog_category_entity t0
                         INNER JOIN store_group t1
                                 ON t1.root_category_id = t0.entity_id
                         INNER JOIN store t2
                                 ON t2.group_id = t1.group_id';

    /**
     * The SQL statement to load the category varchars for a list of entity IDs.
     *
     * @var string
     */
    const CATEGORY_VARCHARS_BY_ENTITY_IDS = 'SELECT t1.*
                                               FROM catalog_category_entity_varchar AS t1
                                         INNER JOIN eav_attribute AS t2
                                                 ON t2.entity_type_id = 3
                                                AND t2.attribute_code = \'name\'
                                                AND t1.attribute_id = t2.attribute_id
                                                AND t1.store_id = 0
                                                AND t1.entity_id IN (?)';

    /**
     * The SQL statement to load the stores.
     *
     * @var string
     */
    const STORES = 'SELECT t1.* FROM store AS t1';

    /**
     * The SQL statement to load the default store.
     *
     * @var string
     */
    const STORE_DEFAULT = 'SELECT t0.*
                             FROM store t0
                       INNER JOIN store_group t1
                               ON t1.default_store_id = t0.store_id
                       INNER JOIN store_website t2
                               ON t1.website_id = t2.website_id
                              AND t2.is_default = 1;';

    /**
     * The SQL statement to load the stores.
     *
     * @var string
     */
    const STORE_WEBSITES = 'SELECT t1.* FROM store_website AS t1';

    /**
     * The SQL statement to load the tax classes.
     *
     * @var string
     */
    const TAX_CLASSES = 'SELECT t1.* FROM tax_class AS t1';

    /**
     * The SQL statement to load all available link types.
     *
     * @var string
     */
    const LINK_TYPES = 'SELECT t1.* FROM catalog_product_link_type AS t1';

    /**
     * The SQL statement to load all available link types.
     *
     * @var string
     */
    const LINK_ATTRIBUTES = 'SELECT t1.* FROM catalog_product_link_attribute AS t1';

    /**
     * The SQL statement to load all available EAV entity types.
     *
     * @var string
     */
    const EAV_ENTITY_TYPES = 'SELECT t1.* FROM eav_entity_type AS t1';

    /**
     * The SQL statement to load the attribute set.
     *
     * @var string
     */
    const EAV_ATTRIBUTE_SET = 'SELECT t1.*
                                 FROM eav_attribute_set AS t1
                                WHERE attribute_set_id = ?';

    /**
     * The SQL statement to load the attribute sets for a specific entity type.
     *
     * @var string
     */
    const EAV_ATTRIBUTE_SETS_BY_ENTITY_TYPE_ID = 'SELECT t1.*
                                                    FROM eav_attribute_set AS t1
                                                   WHERE entity_type_id = ?';

    /**
     * The SQL statement to load EAV attributes by entity type ID and attribute set name.
     *
     * @var string
     */
    const EAV_ATTRIBUTES_BY_ENTITY_TYPE_ID_AND_ATTRIBUTE_SET_NAME = 'SELECT t3.*
                                                                       FROM eav_attribute AS t3
                                                                 INNER JOIN eav_entity_type AS t0
                                                                         ON t0.entity_type_id = :entity_type_id
                                                                 INNER JOIN eav_attribute_set AS t1
                                                                         ON t1.attribute_set_name = :attribute_set_name
                                                                        AND t1.entity_type_id = t0.entity_type_id
                                                                 INNER JOIN eav_entity_attribute AS t2
                                                                         ON t2.attribute_set_id = t1.attribute_set_id
                                                                        AND t3.attribute_id = t2.attribute_id';

    /**
     * The SQL statement to load EAV attributes by attribute option value and store ID.
     *
     * @var string
     */
    const EAV_ATTRIBUTES_BY_OPTION_VALUE_AND_STORE_ID = 'SELECT t1.*
                                                           FROM eav_attribute AS t1
                                                     INNER JOIN eav_attribute_option_value AS t2
                                                             ON t2.value = :value
                                                            AND t2.store_id = :store_id
                                                     INNER JOIN eav_attribute_option AS t3
                                                             ON t3.option_id = t2.option_id
                                                            AND t1.attribute_id = t3.attribute_id';

    /**
     * The SQL statement to load EAV attributes by passed is user defined flag.
     *
     * @var string
     */
    const EAV_ATTRIBUTES_BY_IS_USER_DEFINED = 'SELECT * FROM eav_attribute WHERE is_user_defined = :is_user_defined';

    /**
     * The SQL statement to load the attribute option value.
     *
     * @var string
     */
    const EAV_ATTRIBUTE_OPTION_VALUE = 'SELECT t1.*
                                          FROM eav_attribute_option_value AS t1
                                         WHERE t1.value = ?
                                           AND t1.store_id = ?';

    /**
     * The SQL statement to load the Magento 2 configuration.
     *
     * @var string
     */
    const CORE_CONFIG_DATA = 'SELECT * FROM core_config_data';
}
