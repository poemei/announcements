# Announcements

The Public announcements module for the ChAoS MVC

## Version

1.3.4

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

The Admin screen uses theme-provided surfaces and controls. It does not force
dark backgrounds, light text, or module-specific colors. Every row provides a
visible Edit button and a CSRF-protected Delete button.

All Admin writes use explicit POST actions with CSRF verification. The
module-owned `announcements` table is declared for Core-controlled Nuke.
Fresh installations include `sql/schema.sql` for the database installation
process selected by the domain operator.

The module manifest uses the canonical `type`, `fingerprint`, `sha256`,
`key_id`, and `public_key` signing shape.
