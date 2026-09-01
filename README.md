# announcements

The Public announcements module for the ChAoS MVC

## Version

1.3.2

## Module Location

```text
/user/modules/announcements
```

## Module Files

```text
/user/modules/announcements/controllers/announcements.php
/user/modules/announcements/models/announcements_model.php
/user/modules/announcements/views/admin/announcements.php
/user/modules/announcements/views/admin/index.php
/user/modules/announcements/views/index.php
/user/modules/announcements/sql/schema.sql
/user/modules/announcements/module.json
```

## Administration

Open `/admin/announcements` after installing the module.

All Admin writes use explicit POST actions with CSRF verification. The
module-owned `announcements` table is declared for Core-controlled Nuke.
Fresh installations include `sql/schema.sql` for the database installation
process selected by the domain operator.
