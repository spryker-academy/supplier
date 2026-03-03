# Supplier Module - Training Guide

Complete training progression for the Spryker Academy Supplier module suite.

## 📋 Module Overview

| Module | Version | Branch | Duration | Difficulty |
|--------|---------|--------|----------|-----------|
| Supplier Schema | v4.0 | `ilt/202512.0/intermediate/supplier-schema` | 1 hour | ⭐⭐☆☆☆ |
| Supplier CRUD | v5.0 | `ilt/202512.0/intermediate/supplier-back-office` | 2 hours | ⭐⭐⭐☆☆ |
| Supplier Import | v6.0 | `ilt/202512.0/intermediate/supplier-data-import` | 1.5 hours | ⭐⭐⭐☆☆ |
| Supplier Search Sync | v7.0 | `ilt/202512.0/intermediate/supplier-search` | 2 hours | ⭐⭐⭐⭐☆ |
| Supplier Storage Sync | v8.0 | `ilt/202512.0/intermediate/supplier-storage` | 2 hours | ⭐⭐⭐⭐☆ |
| Supplier Elasticsearch | v9.0 | `ilt/202512.0/intermediate/elasticsearch` | 2 hours | ⭐⭐⭐⭐☆ |
| Supplier Glue API | v10.0 | `ilt/202512.0/intermediate/glue-storefront` | 2 hours | ⭐⭐⭐⭐☆ |
| Supplier OMS | v11.0 | `ilt/202512.0/intermediate/oms` | 3 hours | ⭐⭐⭐⭐⭐ |

---

## Module 4: Supplier Schema and Persistence

### 🎯 Learning Objectives
- Define complex Propel schemas with foreign keys
- Implement Repository pattern for read operations
- Implement EntityManager pattern for write operations
- Use QueryContainer for complex queries
- Work with entity relationships

### 📦 Installation

**Skeleton Version:**
```bash
composer require spryker-academy/supplier:4.0.0-skeleton
```

**Complete Version:**
```bash
composer require spryker-academy/supplier:4.0.0-complete
```

### 📝 What You Need to Do

1. Create schema files:
   ```
   src/SprykerAcademy/Zed/Supplier/Persistence/Propel/Schema/pyz_supplier.schema.xml
   src/SprykerAcademy/Zed/SupplierLocation/Persistence/Propel/Schema/pyz_supplier_location.schema.xml
   ```

2. Define `pyz_supplier` table with:
   - id_supplier (primary key)
   - name (VARCHAR, required)
   - email (VARCHAR)
   - phone (VARCHAR)
   - is_active (BOOLEAN, default true)
   - timestampable behavior

3. Define `pyz_supplier_location` table with:
   - id_supplier_location (primary key)
   - fk_supplier (foreign key to pyz_supplier)
   - address (VARCHAR, required)
   - city (VARCHAR, required)
   - country (VARCHAR, required)
   - timestampable behavior

4. Generate Propel models:
   ```bash
   vendor/bin/console propel:install
   ```

5. Implement Repository and EntityManager classes

### ✅ Completion Criteria
- [ ] Schema XML is valid
- [ ] Tables created with proper relationships
- [ ] Entity classes generated
- [ ] Repository implements read methods
- [ ] EntityManager implements write methods
- [ ] Can save and retrieve suppliers with locations

---

## Module 5: Supplier Back Office CRUD

### 🎯 Learning Objectives
- Create complete CRUD interface in Zed
- Build Symfony forms with validation
- Implement GuiTable for data listing
- Use Facade pattern for business operations
- Add navigation menu items

### 📦 Installation

```bash
composer require spryker-academy/supplier:5.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create SupplierGui module with:**
   - IndexController (list suppliers)
   - CreateController (create new supplier)
   - EditController (update supplier)
   - DeleteController (remove supplier)

2. **Build Symfony forms:**
   - SupplierForm with name, email, phone, is_active fields
   - Form validation rules
   - DataProvider for populating forms

3. **Create GuiTable:**
   - SupplierTable configuration
   - Column definitions with actions
   - Query builder for data source

4. **Implement Business Layer:**
   - SupplierFacade interface and implementation
   - SupplierReader and SupplierWriter models
   - Error handling and validation

5. **Add to navigation:**
   - Update config/Zed/navigation.xml
   - Build navigation cache

### ✅ Completion Criteria
- [ ] Can list all suppliers in table
- [ ] Can create new suppliers via form
- [ ] Can edit existing suppliers
- [ ] Can delete suppliers (soft or hard delete)
- [ ] Validation works correctly
- [ ] Navigation menu shows Suppliers section
- [ ] Access at: http://backoffice.eu.spryker.local/supplier-gui

---

## Module 6: Supplier Data Import

### 🎯 Learning Objectives
- Create data import configurations
- Implement DataImport writer steps
- Work with CSV files
- Handle bulk data operations
- Use data import console commands

### 📦 Installation

```bash
composer require spryker-academy/supplier:6.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create SupplierDataImport module:**
   - SupplierWriterStep for supplier import
   - SupplierLocationWriterStep for location import

2. **Define import configurations:**
   - data/import/common/common/supplier.csv
   - data/import/common/common/supplier_location.csv

3. **Implement writer steps:**
   - Parse CSV data
   - Validate required fields
   - Create or update entities
   - Handle relationships

4. **Register data import types:**
   - Add to DataImportDependencyProvider
   - Configure import order

5. **Run imports:**
   ```bash
   vendor/bin/console data:import supplier
   vendor/bin/console data:import supplier-location
   ```

### ✅ Completion Criteria
- [ ] CSV files are properly formatted
- [ ] Writer steps process all rows
- [ ] Suppliers imported to database
- [ ] Locations linked to suppliers
- [ ] Import handles duplicates gracefully
- [ ] Can re-run import without errors

---

## Module 7: Supplier Publish & Synchronize (Search)

### 🎯 Learning Objectives
- Implement Publish & Synchronize pattern
- Work with message queues
- Create publisher plugins
- Configure synchronization
- Understand event-driven architecture

### 📦 Installation

```bash
composer require spryker-academy/supplier:7.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create SupplierSearch module:**
   - Map suppliers to search documents
   - Define pyz_supplier_search table

2. **Implement Publisher:**
   - SupplierWritePublisher plugin
   - Listen to supplier create/update/delete events
   - Write to pyz_supplier_search table

3. **Configure synchronization:**
   - Add to SynchronizationDependencyProvider
   - Configure queue processors
   - Define synchronization pool

4. **Test the flow:**
   ```bash
   # Create/update supplier in Back Office
   # Check queue:
   vendor/bin/console queue:worker:start
   # Verify data in pyz_supplier_search
   ```

### ✅ Completion Criteria
- [ ] Publisher listens to entity events
- [ ] Data written to search table
- [ ] Queue processes messages
- [ ] Synchronization runs successfully
- [ ] Can track data flow from DB to search table

---

## Module 8: Supplier Publish & Synchronize (Storage)

### 🎯 Learning Objectives
- Implement Redis storage synchronization
- Work with key-value storage
- Build storage clients
- Optimize data for frontend access
- Handle cache invalidation

### 📦 Installation

```bash
composer require spryker-academy/supplier:8.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create SupplierStorage module:**
   - Map suppliers to storage documents
   - Define pyz_supplier_storage table

2. **Implement Publisher:**
   - SupplierStoragePublisher plugin
   - Write to pyz_supplier_storage table
   - Generate storage keys

3. **Create SupplierStorageClient:**
   - Read supplier data from Redis
   - Use SynchronizationService for key building
   - Implement findSupplierStorageData() method

4. **Configure synchronization to Redis:**
   - Add storage synchronization plugin
   - Configure Redis sync queue

5. **Test the flow:**
   ```bash
   # Create/update supplier
   vendor/bin/console queue:worker:start
   # Check Redis:
   redis-cli KEYS "supplier:*"
   redis-cli GET "supplier:1"
   ```

### ✅ Completion Criteria
- [ ] Data published to storage table
- [ ] Synchronized to Redis
- [ ] Client can read from Redis
- [ ] Keys are properly formatted
- [ ] Data structure optimized for reads

---

## Module 9: Supplier Elasticsearch Integration

### 🎯 Learning Objectives
- Index data to Elasticsearch
- Configure search mappings
- Implement search queries
- Work with search client
- Build search results

### 📦 Installation

```bash
composer require spryker-academy/supplier:9.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create Elasticsearch mapping:**
   - Define supplier.json schema
   - Configure analyzers and fields
   - Set up index settings

2. **Implement SupplierSearchClient:**
   - Build search queries
   - Implement pagination
   - Add filtering capabilities
   - Format search results

3. **Create map plugins:**
   - SupplierSearchMapPlugin for indexing
   - Configure mapping for search

4. **Sync to Elasticsearch:**
   ```bash
   vendor/bin/console search:setup:sources
   vendor/bin/console queue:worker:start
   ```

5. **Test search:**
   - Query Elasticsearch directly
   - Use client in code
   - Verify results

### ✅ Completion Criteria
- [ ] Elasticsearch index created
- [ ] Suppliers indexed with correct mapping
- [ ] Can search by supplier name
- [ ] Search results return correct data
- [ ] Pagination works correctly
- [ ] Can verify at: http://localhost:9200/supplier_search/_search

---

## Module 10: Supplier Glue API Platform

### 🎯 Learning Objectives
- Create RESTful API resources
- Use API Platform integration
- Implement resource providers
- Build OpenAPI documentation
- Work with Glue Storefront

### 📦 Installation

```bash
composer require spryker-academy/supplier:10.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create Supplier Glue module:**
   - SuppliersStorefrontProvider resource provider
   - SupplierMapper for data transformation
   - Configure resource routing

2. **Define OpenAPI spec:**
   - suppliers.resource.yml
   - Define endpoints, request/response formats
   - Add validation rules

3. **Create SupplierLocation Glue module:**
   - SupplierLocationsStorefrontProvider
   - SupplierLocationMapper
   - supplier-locations.resource.yml

4. **Integrate with Client layer:**
   - Read from SupplierSearchClient or SupplierStorageClient
   - Transform to API response format

5. **Test endpoints:**
   ```bash
   # Get all suppliers
   curl http://glue.eu.spryker.local/suppliers

   # Get supplier by ID
   curl http://glue.eu.spryker.local/suppliers/1

   # Get supplier locations
   curl http://glue.eu.spryker.local/supplier-locations?filter[fk_supplier]=1
   ```

### ✅ Completion Criteria
- [ ] API endpoints respond correctly
- [ ] OpenAPI documentation generated
- [ ] JSON responses properly formatted
- [ ] Error handling works
- [ ] Can filter and paginate results
- [ ] CORS configured if needed

---

## Module 11: Supplier OMS Integration

### 🎯 Learning Objectives
- Understand Order Management System (OMS)
- Create OMS state machines
- Implement OMS commands and conditions
- Integrate custom entities with orders
- Build order processing workflows

### 📦 Installation

```bash
composer require spryker-academy/supplier:11.0.0-skeleton
```

### 📝 What You Need to Do

1. **Create OMS state machine:**
   - Define Demo01.xml with supplier states
   - Add transitions for supplier assignment
   - Configure commands and conditions

2. **Implement OMS plugins:**
   - SupplierOrderItemCommandPlugin
   - SupplierOrderItemConditionPlugin
   - SupplierSavePlugin (for order save)

3. **Add Supplier to Order Items:**
   - Extend spy_sales_order_item with fk_supplier
   - Create schema extension
   - Run propel:install

4. **Build assignment logic:**
   - Assign suppliers to order items
   - Update supplier inventory
   - Handle supplier availability

5. **Test OMS flow:**
   - Place order in Yves
   - Check order in Back Office
   - Trigger state transitions
   - Verify supplier assignment

### ✅ Completion Criteria
- [ ] State machine renders in Back Office
- [ ] Can assign suppliers to orders
- [ ] Commands execute correctly
- [ ] Conditions evaluate properly
- [ ] Order items show supplier information
- [ ] Complete order flow works end-to-end

---

## 🔄 Version Mapping

| Module | Skeleton Tag | Complete Tag | Branch Pattern |
|--------|-------------|-------------|----------------|
| Schema | v4.0.0-skeleton | v4.0.0-complete | `ilt/202512.0/intermediate/supplier-schema/*` |
| CRUD | v5.0.0-skeleton | v5.0.0-complete | `ilt/202512.0/intermediate/supplier-back-office/*` |
| Import | v6.0.0-skeleton | v6.0.0-complete | `ilt/202512.0/intermediate/supplier-data-import/*` |
| Search Sync | v7.0.0-skeleton | v7.0.0-complete | `ilt/202512.0/intermediate/supplier-search/*` |
| Storage Sync | v8.0.0-skeleton | v8.0.0-complete | `ilt/202512.0/intermediate/supplier-storage/*` |
| Elasticsearch | v9.0.0-skeleton | v9.0.0-complete | `ilt/202512.0/intermediate/elasticsearch/*` |
| Glue API | v10.0.0-skeleton | v10.0.0-complete | `ilt/202512.0/intermediate/glue-storefront/*` |
| OMS | v11.0.0-skeleton | v11.0.0-complete | `ilt/202512.0/intermediate/oms/*` |

---

## 🛠️ Common Commands

### Generate Code
```bash
# Generate Transfer objects
vendor/bin/console transfer:generate

# Install Propel (creates DB schema)
vendor/bin/console propel:install

# Setup Elasticsearch
vendor/bin/console search:setup:sources

# Build navigation cache
vendor/bin/console navigation:build-cache

# Process queues
vendor/bin/console queue:worker:start
```

### Import Data
```bash
# Import suppliers
vendor/bin/console data:import supplier

# Import supplier locations
vendor/bin/console data:import supplier-location
```

### Check Installation
```bash
# View installed version
composer show spryker-academy/supplier

# List available versions
composer show spryker-academy/supplier --all
```

### Switch Versions
```bash
# Move to next module
composer require spryker-academy/supplier:5.0.0-skeleton

# Check solution
composer require spryker-academy/supplier:5.0.0-complete

# Back to skeleton
composer require spryker-academy/supplier:5.0.0-skeleton
```

---

## 📚 Prerequisites

Before starting the Supplier module, you should have completed:
- **HelloWorld Module** (Modules 1-4)
- Understanding of Spryker architecture
- Familiarity with Propel ORM
- Basic knowledge of message queues
- Understanding of REST APIs

---

## 🆘 Troubleshooting

### Issue: Tables not created
**Solution:** Run `vendor/bin/console propel:install`

### Issue: Queue not processing
**Solution:** Start queue worker: `vendor/bin/console queue:worker:start`

### Issue: Elasticsearch index not found
**Solution:** Run `vendor/bin/console search:setup:sources`

### Issue: API returns 404
**Solution:** Clear cache with `vendor/bin/console cache:empty-all` and rebuild router cache

### Issue: Redis keys not found
**Solution:** Check storage synchronization is configured and queue worker is running

### Issue: OMS state machine not visible
**Solution:** Ensure Demo01.xml is in config/Zed/oms/ and cache is cleared

---

## 🎓 Learning Path

1. **Complete HelloWorld first** - Modules 1-4 are prerequisites
2. **Start with Schema** - Install v4.0-skeleton
3. **Progress sequentially** - Each module builds on the previous
4. **Test thoroughly** - Verify each component before moving forward
5. **Compare with complete** - Use complete versions to check your work

---

**Happy Learning! 🚀**
