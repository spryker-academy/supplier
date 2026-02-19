# Spryker Academy - Supplier Training Module Suite

[![Latest Version](https://img.shields.io/github/v/tag/spryker-academy/supplier?label=version)](https://github.com/spryker-academy/supplier/tags)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Master intermediate and advanced Spryker concepts through building a complete Supplier management system with CRUD operations, data import, search, storage, API endpoints, and OMS integration.

## 📚 What You'll Learn

This comprehensive training module covers real-world Spryker development through 7 progressive exercises:

1. **Supplier Table Schema** - Advanced Propel schemas with relationships
2. **Back Office CRUD** - Forms, tables, validation, and user interactions
3. **Data Import** - CSV import with data processors and transformations
4. **Publish & Synchronize** - Event-driven architecture with Elasticsearch and Redis
5. **Elasticsearch Integration** - Search with query builders and formatters
6. **API Platform (Glue)** - REST API development with API Platform
7. **Order Management System** - State machines and OMS integration

## 🎯 Prerequisites

- PHP 8.4 or higher
- Completed HelloWorld training module (recommended)
- Spryker project (B2B/B2C Demo Shop or Suite)
- Understanding of MVC and object-oriented programming
- Docker environment

## 📦 What's Included

### Modules in This Package

- **Supplier** - Core business logic and persistence
- **SupplierGui** - Back Office CRUD interface
- **SupplierDataImport** - CSV import functionality
- **SupplierSearch** - Elasticsearch synchronization
- **SupplierStorage** - Redis synchronization (write)
- **SupplierStorageClient** - Redis client (read)
- **SupplierLocation** - Related entity with one-to-many relationship
- **Oms** - Order Management System plugins

### Additional Files

- CSV data samples
- Navigation configuration
- Elasticsearch schema
- Transfer object definitions
- Propel schemas

## 🚀 Installation

### Install Specific Training Version

```bash
# Start with table schema
composer require spryker-academy/supplier:4.0-skeleton

# Or jump to Back Office CRUD
composer require spryker-academy/supplier:6.0-skeleton

# Install complete version to see solutions
composer require spryker-academy/supplier:6.0-complete
```

### Install from Branch (Alternative)

```bash
composer require spryker-academy/supplier:dev-ilt/202512.0/intermediate/back-office/skeleton
```

## 📖 Training Progression

### Module 4: Supplier Table Schema (v4.0)

**Duration:** 1 hour | **Difficulty:** ⭐⭐☆☆☆

Learn advanced Propel schemas with foreign keys and relationships.

```bash
composer require spryker-academy/supplier:4.0-skeleton
```

**You'll Build:**
- Supplier table with proper columns
- SupplierLocation table with foreign key
- One-to-many relationship
- Transfer objects for both entities

---

### Module 6: Back Office CRUD (v6.0)

**Duration:** 3 hours | **Difficulty:** ⭐⭐⭐☆☆

Build a complete Back Office management interface.

```bash
composer require spryker-academy/supplier:6.0-skeleton
```

**You'll Build:**
- CRUD controllers (Create, Read, Update, Delete)
- Symfony forms with validation
- Data tables with sorting and pagination
- Navigation menu integration

**Access:** `http://backoffice.eu.spryker.local/supplier-gui`

---

### Module 7: Data Import (v7.0)

**Duration:** 2 hours | **Difficulty:** ⭐⭐⭐☆☆

Import data from CSV files with transformations.

```bash
composer require spryker-academy/supplier:7.0-skeleton
```

**You'll Build:**
- Data import configuration
- Writer steps for Supplier and SupplierLocation
- Data transformation processors
- Batch import handling

**Command:** `vendor/bin/console data:import:supplier`

---

### Module 8: Publish & Synchronize (v8.0)

**Duration:** 3 hours | **Difficulty:** ⭐⭐⭐⭐☆

Implement event-driven data synchronization to Elasticsearch and Redis.

```bash
composer require spryker-academy/supplier:8.0-skeleton
```

**You'll Build:**
- SupplierSearch module (Elasticsearch)
- SupplierStorage module (Redis write)
- SupplierStorageClient (Redis read)
- Publisher plugins for events
- Queue configuration

**Architecture:** Database → Events → Queue → Elasticsearch + Redis

---

### Module 9: Elasticsearch Integration (v9.0)

**Duration:** 3 hours | **Difficulty:** ⭐⭐⭐⭐☆

Build search functionality with Elasticsearch.

```bash
composer require spryker-academy/supplier:9.0-skeleton
```

**You'll Build:**
- Search client with query builders
- Result formatters
- Fuzzy search and filters
- Search suggestions

**Test:** Search for suppliers by name, description, location

---

### Module 10: API Platform - Glue (v10.0)

**Duration:** 3 hours | **Difficulty:** ⭐⭐⭐⭐☆

Create REST API endpoints with Spryker API Platform.

```bash
composer require spryker-academy/supplier:10.0-skeleton
```

**You'll Build:**
- API resource providers
- GET, POST operations
- Search integration
- Response formatting

**Endpoints:**
- `GET /suppliers` - List all suppliers
- `GET /suppliers/{id}` - Get single supplier
- `POST /suppliers` - Create supplier
- `GET /suppliers?q=acme` - Search suppliers

---

### Module 11: Order Management System (v11.0)

**Duration:** 4 hours | **Difficulty:** ⭐⭐⭐⭐⭐

Integrate with Spryker OMS using state machines.

```bash
composer require spryker-academy/supplier:11.0-skeleton
```

**You'll Build:**
- OMS command plugins
- OMS condition plugins
- State machine XML configuration
- Order state transitions

**Learn:** State machines, event-driven order processing

---

## ⚙️ Configuration

### 1. Register SprykerAcademy Namespace

Add to `config/Shared/config_default.php`:

```php
use Spryker\Shared\Kernel\KernelConstants;

$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerShop',
    'SprykerEco',
    'Spryker',
    'SprykerSdk',
    'SprykerAcademy', // Add this
];
```

### 2. Run Code Generation

**⚠️ IMPORTANT:** This package does NOT include generated Propel entity classes (Orm namespace).
You MUST generate them by running `propel:install` first!

```bash
# 1. FIRST: Generate Propel entity classes (required!)
#    This creates the Orm classes that the modules depend on
vendor/bin/console propel:install

# 2. Generate transfer objects
vendor/bin/console transfer:generate

# Build navigation cache
vendor/bin/console navigation:build-cache

# Setup search (Module 9+)
vendor/bin/console elasticsearch:index:install

# Setup storage sync (Module 8+)
vendor/bin/console queue:setup
```

### 3. Import Sample Data (Module 7+)

```bash
vendor/bin/console data:import:supplier
vendor/bin/console data:import:supplier-location
```

## 🏗️ Module Structure

```
src/SprykerAcademy/
├── Zed/
│   ├── Supplier/              # Core module
│   ├── SupplierGui/           # Back Office
│   ├── SupplierDataImport/    # Data import
│   ├── SupplierSearch/        # Elasticsearch sync
│   ├── SupplierStorage/       # Redis sync (write)
│   ├── SupplierLocation/      # Related entity
│   └── Oms/                   # OMS plugins
├── Client/
│   ├── Supplier/              # Client layer
│   ├── SupplierSearch/        # Search client
│   ├── SupplierStorage/       # Storage client (read)
│   └── SupplierLocation/      # Location client
├── Glue/
│   ├── Supplier/              # API resources
│   └── SupplierLocation/      # Location API
└── Shared/
    ├── Supplier/              # Transfer definitions
    ├── SupplierSearch/        # Search config
    └── SupplierStorage/       # Storage config
```

## 📊 Version Mapping

| Module | Version | Branch | Duration |
|--------|---------|--------|----------|
| Supplier Schema | v4.0 | `ilt/202512.0/basics/supplier-table-schema/*` | 1 hour |
| Back Office CRUD | v6.0 | `ilt/202512.0/intermediate/back-office/*` | 3 hours |
| Data Import | v7.0 | `ilt/202512.0/intermediate/data-import/*` | 2 hours |
| Publish & Sync | v8.0 | `ilt/202512.0/intermediate/publish-synchronize/*` | 3 hours |
| Search | v9.0 | `ilt/202512.0/intermediate/search/*` | 3 hours |
| API Platform | v10.0 | `ilt/202512.0/intermediate/glue-storefront/*` | 3 hours |
| OMS | v11.0 | `ilt/202512.0/intermediate/oms/*` | 4 hours |

## 🔄 Switching Versions

```bash
# Move to next exercise
composer require spryker-academy/supplier:7.0-skeleton

# Check solution
composer require spryker-academy/supplier:7.0-complete

# Back to skeleton
composer require spryker-academy/supplier:7.0-skeleton
```

## 🛠️ Common Commands

```bash
# Generate code
vendor/bin/console transfer:generate
vendor/bin/console propel:install

# Import data
vendor/bin/console data:import:supplier

# Publish to storage/search
vendor/bin/console publish:trigger-events
vendor/bin/console queue:worker:start

# Search operations
vendor/bin/console elasticsearch:index:install
vendor/bin/console search:setup:sources

# Clear cache
vendor/bin/console cache:empty-all
```

## 📚 Prerequisites

**Recommended Order:**
1. Complete HelloWorld training module first
2. Understand Transfer objects and Propel ORM
3. Familiar with Spryker architecture (Zed, Client, Yves)

**Skip to Intermediate:**
If you're already familiar with Spryker basics, you can start directly with Module 6 (Back Office CRUD).

## 🆘 Troubleshooting

### Issue: Tables not created
**Solution:** Run `vendor/bin/console propel:install`

### Issue: Transfer classes not found
**Solution:** Run `vendor/bin/console transfer:generate`

### Issue: Navigation not showing
**Solution:** Run `vendor/bin/console navigation:build-cache`

### Issue: Search not working
**Solution:** Run `vendor/bin/console elasticsearch:index:install && vendor/bin/console publish:trigger-events`

### Issue: API returns 404
**Solution:** Clear cache with `vendor/bin/console cache:empty-all`

## 📖 Additional Resources

- [Spryker Documentation](https://docs.spryker.com)
- [Training Manual](../../docs/training/SPRYKER_TRAINING_MANUAL.md)
- [Student Exercise Guide](../../docs/training/STUDENT_EXERCISE_GUIDE.md)

## 🤝 Contributing

This is a training module. For issues or improvements, please contact Spryker Academy.

## 📄 License

MIT License - See [LICENSE](LICENSE) file for details.

---

**Ready to Master Spryker? Start Now! 🚀**

```bash
composer require spryker-academy/supplier:6.0-skeleton
```
