# Macros

Macros written in `template.htm` and `.md` files will be replaced with the corresponding value.

Macros use the following syntax: `\$$(MACRO_NAME)` and `\$${MACRO_NAME}`.

Some macros have parameters: `\$$(MACRO_NAME,parameter)`.

## Available macros

- `\$$(INCLUDE,filename)` - Inserts content of `filename`. File path is relative to site root.
- `\$$(PAGE_CONTENT)` - current page content in HTML format (only in `template.htm`).
- `\$$(PAGE_TITLE)` - current page title, is taken from heading 1 level of markdown text.
- `\$$(PAGE_URL)` - current page URL.
- `\$$(SITE_AUTHOR)` - is taken from `.config` file `$siteAuthor` property.
- `\$$(SITE_TITLE)` - is taken from `.config` file `$siteTitle` property.
- `\$$(SITE_URL)` - site root URL (where `.config` is located). This string is empty for the root folder.
- `\$$(THIS_YEAR)` - 4 digit current year (e.g. `2016`). \\
&nbsp;
- `\$$(FOLDER_LIST)` - Bulleted list of subfolder names, for the current folder.
- `\$$(PAGE_LIST)` - Bulleted list of page names, for the current folder. Does not include `index.md` file.
- `\$$(PAGE_LIST_ALL)` - Bulleted list of all page names, including subfolders. Does not include `index.md` files.
- `\$$(FOLDER_LIST,folder)` - Bulleted list of subfolder names, for the given folder. Path is relative to site root.


Example:

```
<link rel="stylesheet" type="text/css" href="\$$(SITE_URL)/css/default.css" />
```

## Macros with markdown parsed

Same as above, but using curly brakets (instead of round ones), e.g. - `\$${FOLDER_LIST}`.

Mosly useful in `template.htm`. For example, following line shows a menu of top-level site sections:

```
<div id="menu">\$${FOLDER_LIST,/}</div>
```

## Macros escapes

If you want to use any of these macros as a literal, you need to escape them with a backslash:

```
- `\\$$(PAGE_URL)` - current page URL.
```

```
You can use \\$${FOLDER_LIST} macro to show a site menu.
```
