# Announcements Module Changes

## 1.3.3 - 2026-08-31

- Restored the established `get_latest_single()`, `get_latest()`, `get_active()`, `get_all()`, and `get_by_id()` read APIs used by existing domain modules.
- Preserved the compliant internal CRUD implementation without breaking installed consumers such as Home.
- Restored Admin edit routing for both supported Core parameter shapes.
- Restored a clearly visible Edit action in the Admin announcement list.
- Removed remaining surface and color assumptions so the Admin view follows the active theme.

## 1.3.2 - 2026-08-31

- Added explicit allowlisted Admin actions for create, update, and delete.
- Standardized administrator authorization and CSRF enforcement.
- Confined CRUD to fixed, parameterized module-model operations.
- Restored the fresh-install schema and current module view layout.
- Made the Admin presentation theme-agnostic.
- Added complete signing metadata for Core and Module Builder validation.

<!-- [AI:GPT-5.6 | 2026-09-01 05:00:00 UTC] -->
<!-- [End AI:GPT-5.6] -->
