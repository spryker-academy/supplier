# Propel Schemas and Generated Classes

This package includes Propel schema definitions that **generate** the Orm entity classes when you run `propel:install`.

## ⚠️ Important

The **Orm classes are NOT included** in this package. You MUST generate them by running:

```bash
vendor/bin/console propel:install
```

## 📋 Included Schemas

### 1. pyz_supplier.schema.xml
**Location:** `src/SprykerAcademy/Zed/Supplier/Persistence/Propel/Schema/`

**Generates:**
- `Orm\Zed\Supplier\Persistence\PyzSupplier`
- `Orm\Zed\Supplier\Persistence\PyzSupplierQuery`
- `Orm\Zed\Supplier\Persistence\Base\PyzSupplier`
- `Orm\Zed\Supplier\Persistence\Base\PyzSupplierQuery`
- `Orm\Zed\Supplier\Persistence\Map\PyzSupplierTableMap`

**Used by:**
- `Supplier/Persistence/SupplierEntityManager.php`
- `Supplier/Persistence/SupplierRepository.php`
- `Supplier/Persistence/Propel/Mapper/SupplierMapper.php`
- `SupplierDataImport/Business/DataImportStep/SupplierWriterStep.php`
- `SupplierGui/Communication/Table/SupplierTable.php`

---

### 2. pyz_supplier_location.schema.xml
**Location:** `src/SprykerAcademy/Zed/SupplierLocation/Persistence/Propel/Schema/`

**Generates:**
- `Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation`
- `Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocationQuery`
- `Orm\Zed\SupplierLocation\Persistence\Base\PyzSupplierLocation`
- `Orm\Zed\SupplierLocation\Persistence\Base\PyzSupplierLocationQuery`
- `Orm\Zed\SupplierLocation\Persistence\Map\PyzSupplierLocationTableMap`

**Used by:**
- `SupplierLocation/Persistence/SupplierLocationEntityManager.php`
- `SupplierLocation/Persistence/SupplierLocationRepository.php`
- `SupplierLocation/Persistence/Propel/Mapper/SupplierLocationMapper.php`
- `SupplierDataImport/Business/DataImportStep/SupplierLocationWriterStep.php`

---

### 3. pyz_supplier_search.schema.xml
**Location:** `src/SprykerAcademy/Zed/SupplierSearch/Persistence/Propel/Schema/`

**Generates:**
- `Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearch`
- `Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearchQuery`
- `Orm\Zed\SupplierSearch\Persistence\Base\PyzSupplierSearch`
- `Orm\Zed\SupplierSearch\Persistence\Base\PyzSupplierSearchQuery`
- `Orm\Zed\SupplierSearch\Persistence\Map\PyzSupplierSearchTableMap`

**Used by:**
- `SupplierSearch/Persistence/SupplierSearchEntityManager.php`
- `SupplierSearch/Persistence/SupplierSearchRepository.php`
- `SupplierSearch/Persistence/Propel/Mapper/SupplierSearchMapper.php`
- `SupplierSearch/Communication/Plugin/Publisher/SupplierPublisherTriggerPlugin.php`

---

### 4. pyz_supplier_storage.schema.xml
**Location:** `src/SprykerAcademy/Zed/SupplierStorage/Persistence/Propel/Schema/`

**Generates:**
- `Orm\Zed\SupplierStorage\Persistence\PyzSupplierStorage`
- `Orm\Zed\SupplierStorage\Persistence\PyzSupplierStorageQuery`
- `Orm\Zed\SupplierStorage\Persistence\Base\PyzSupplierStorage`
- `Orm\Zed\SupplierStorage\Persistence\Base\PyzSupplierStorageQuery`
- `Orm\Zed\SupplierStorage\Persistence\Map\PyzSupplierStorageTableMap`

**Used by:**
- `SupplierStorage/Persistence/SupplierStorageEntityManager.php`
- `SupplierStorage/Persistence/SupplierStorageRepository.php`
- `SupplierStorage/Persistence/Propel/Mapper/SupplierStorageMapper.php`

---

## 🔧 Generation Process

When you run `vendor/bin/console propel:install`, Spryker will:

1. **Find all schema files** in vendor packages and your project
2. **Merge schemas** to create complete database schema
3. **Generate Propel entity classes** in `src/Orm/`
4. **Create database tables** based on schemas
5. **Generate migration files** for schema changes

## 📊 Database Tables Created

| Table | Schema File | Purpose |
|-------|------------|---------|
| `pyz_supplier` | pyz_supplier.schema.xml | Store supplier data (name, email, phone, status) |
| `pyz_supplier_location` | pyz_supplier_location.schema.xml | Store supplier locations (address, city, country) |
| `pyz_supplier_search` | pyz_supplier_search.schema.xml | Store Elasticsearch sync data |
| `pyz_supplier_storage` | pyz_supplier_storage.schema.xml | Store Redis sync data |

## 🔧 Synchronization Behavior

The `pyz_supplier_search` and `pyz_supplier_storage` schemas use the **synchronization behavior** which requires specific parameters:

### Required Parameters:
- **resource**: The resource name (e.g., "supplier")
- **key_suffix_column**: The column used to build storage/search keys (e.g., "fk_supplier")
- **queue_group**: The queue group name (e.g., "sync.storage.supplier" or "sync.search.supplier")

### Example (SupplierStorage):
```xml
<behavior name="synchronization">
    <parameter name="resource" value="supplier"/>
    <parameter name="key_suffix_column" value="fk_supplier"/>
    <parameter name="queue_group" value="sync.storage.supplier"/>
</behavior>
```

Without these parameters, you'll get: `PyzSupplierStorage misses "resource" synchronization parameter`

---

## ❌ Common Errors

### Error: Class 'Orm\Zed\SupplierStorage\Persistence\PyzSupplierStorage' not found

**Cause:** Propel entity classes haven't been generated yet.

**Solution:** Run `vendor/bin/console propel:install`

### Error: Table 'pyz_supplier' doesn't exist

**Cause:** Database tables haven't been created yet.

**Solution:** Run `vendor/bin/console propel:install`

### Error: Cannot instantiate abstract class Orm\Zed\Supplier\Persistence\Base\PyzSupplier

**Cause:** You're trying to use the Base class directly. You should use the generated class in the parent directory.

**Solution:** Use `PyzSupplier` not `Base\PyzSupplier`

---

## 📚 Learn More

- [Spryker Propel Documentation](https://docs.spryker.com/docs/scos/dev/back-end-development/zed/persistence-layer/persistence-layer.html)
- [Propel ORM Documentation](http://propelorm.org/documentation/)
- Module 4 in TRAINING.md for hands-on practice with schemas

---

**Note:** This is standard Spryker practice. All Spryker modules with database tables use Propel schemas that generate Orm classes at runtime, not at package distribution time.
