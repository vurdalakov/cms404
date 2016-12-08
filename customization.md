# cms404 customization

### Macros

Following macros will be replaced in `template.htm` and `.md` files:

- `$$(INCLUDE,filename)` - Inserts content of `filename`. File path is relative to site root.
- `$$(PAGE_CONTENT)` - current page content in HTML format (only in `template.htm`).
- `$$(PAGE_TITLE)` - current page title, is taken from heading 1 level of markdown text.
- `$$(PAGE_URL)` - current page URL.
- `$$(SITE_AUTHOR)` - is taken from `.config` file `$siteAuthor` property.
- `$$(SITE_TITLE)` - is taken from `.config` file `$siteTitle` property.
- `$$(SITE_URL)` - site root URL (where `.config` is located).
- `$$(THIS_YEAR)` - 4 digit current year (e.g. `2016`).

### `.config` file property

- `$siteAuthor` - site author, replaces `$$(SITE_AUTHOR)` macro
- `$siteTitle` - site title, replaces `$$(SITE_TITLE)` macro
- `$gitTag` - secret tag to be used in update from Git repository.
- `$error404` - location of `.md` file shown when error 404 occures.
