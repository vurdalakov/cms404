# Properties

Properties must be defined one per line, starting from the first line.

Property names must start with `$` sign. Property value is separated from property name with `=` character:

```
$title=Home page
```

All lines below first empty line or line without a property definition will be ignored.

Properties are not rendered to HTML view.

## Site properties

Site properties are defined in the `.config` file located in the root folder.

- `$siteAuthor` - site author, replaces `\$$(SITE_AUTHOR)` macro.
- `$siteTitle` - site title, replaces `\$$(SITE_TITLE)` macro.

- `$error404` - location of `.md` file shown when error 404 occures.
- `$templateFileName` - template file name, relative to site root.

- `$gitTag` - secret tag to be used in Git update.
- `$gitPath` - path to Git executable.
- `$gitRemote` - Git remote path.
- `$adminEmail` - webmaster email to receive Git update status. Remove or keep empty to disable email sending.

Default content of `.config` file:

```
$siteAuthor=vurdalakov
$siteTitle=cms404
$error404=.custom/error404.md
$templateFileName=.custom/template.htm
$gitTag=cms404tag
$gitPath=/usr/local/bin/git
$gitRemote=origin/master
$adminEmail=vurdalakov@gmail.com
```

## Folder properties

Folder properties are defined in `.folder` and/or `index.md` files located in that folder.

If some property is defined in both `.folder` and `index.md` files, then property value from `index.md` file is used.

- `$title` - defines folder title. If not defined, folder name is used as title.
- `$order` - defines folder order in `\$$(FOLDER_LIST)` list. If not defined, folders are sorted by folder name.
- `$ignore` - if set to any other value than `0`, folder is excluded from `\$$(FOLDER_LIST)` list.

Examples:

```
$title=Usage examples
$order=4
```

```
$ignore=1
```

## File properties

File properties can be defined in the first lines of `.md` file.

- `$title` - defines file title. If not defined, level 1 header (`#`) is used as title. If not defined, file name without extension is used as title.
- `$order` - defines folder order in `\$$(FILE_LIST)` list. If not defined, files are sorted by file name.
- `$ignore` - if set to any other value than `0`, file is excluded from `\$$(FILE_LIST)` list.

Examples:

```
$title=Multithreaded example
$order=2
```

```
$ignore=1
```
