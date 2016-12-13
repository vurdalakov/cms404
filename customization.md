# cms404 customization

### Macros

Following macros will be replaced in `template.htm` and `.md` files:

- `\$$(INCLUDE,filename)` - Inserts content of `filename`. File path is relative to site root.
- `\$$(PAGE_CONTENT)` - current page content in HTML format (only in `template.htm`).
- `\$$(PAGE_TITLE)` - current page title, is taken from heading 1 level of markdown text.
- `\$$(PAGE_URL)` - current page URL.
- `\$$(SITE_AUTHOR)` - is taken from `.config` file `$siteAuthor` property.
- `\$$(SITE_TITLE)` - is taken from `.config` file `$siteTitle` property.
- `\$$(SITE_URL)` - site root URL (where `.config` is located).
- `\$$(THIS_YEAR)` - 4 digit current year (e.g. `2016`).

- `\$$(FOLDER_LIST)` - Bulleted list of subfolder names, for the current folder.
- `\$$(PAGE_LIST)` - Bulleted list of page names, for the current folder. Does not include `index.md` file.
- `\$$(PAGE_LIST_ALL)` - Bulleted list of all page names, including subfolders. Does not include `index.md` files.
- `\$$(FOLDER_LIST,folder)` - Bulleted list of subfolder names, for the given folder. Path is relative to site root.

Example:

```
<link rel="stylesheet" type="text/css" media="screen,print" href="\$$(SITE_URL)/css/default.css" />
```

If you want to use any of these macros as a literal, you need to escape them with a backslash.

### Macros with markdown parsed

Same as above, but using curly brakets (instead of round ones), e.g. - `\$${FOLDER_LIST}`.

Mosly useful in `template.htm`. For example, following line shows a menu of top-level site sections:

```
<div id="menu">\$${FOLDER_LIST,/}</div>
```

### Site properties

Site properties are located in the `.config` file.

- `$siteAuthor` - site author, replaces `\$$(SITE_AUTHOR)` macro
- `$siteTitle` - site title, replaces `\$$(SITE_TITLE)` macro

- `$error404` - location of `.md` file shown when error 404 occures.
- `$templateFileName` - template file name, relative to site root.

- `$gitTag` - secret tag to be used in Git update.
- `$gitPath` - path to Git executable
- `adminEmail` - webmaster email to receive Git update status. Remove or keep empty to disable email sending.

Note that empty lines are not allowed in `.config` file, everything below an empty line will be ignored.

Default content of `.config` file:

```
$siteAuthor=vurdalakov
$siteTitle=cms404
$error404=.custom/error404.md
$templateFileName=.custom/template.htm
$gitTag=cms404tag
$gitPath=/usr/local/bin/git
$adminEmail=vurdalakov@gmail.com
```
