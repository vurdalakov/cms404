# Quick start

## Requirements

- Web hosting with PHP5 support.
- eAccelerator PHP extension disabled.
- File upload support (FTP/SFTP/etc.) or Git and SSH support.

## Update site using FTP/SFTP/etc.

1. Download this [GitHub repository](https://github.com/vurdalakov/cms404) content.
1. Replace `.md` files with your own content.
1. Customize `template.htm`, `default.css`, `.config` and `.folder` files to follow your needs. Use [site, folder and file properties](properties.md) and [macros](macros.md).
1. Upload repository content to any place of your site.

## Update site using Git

1. Fork this [GitHub repository](https://github.com/vurdalakov/cms404).
1. Replace `.md` files with your own content.
1. Customize `template.htm`, `default.css`, `.config` and `.folder` files to follow your needs. Use [site, folder and file properties](properties.md) and [macros](macros.md).
1. Set `$gitTag` property (any URL-encoded string) in `.config` file.
1. Clone your repository to your site (e.g. using SSH).
1. Configure deployment key in Git repository and copy it to your web site.
1. Configure webhook in Git repository to POST to `<your site root>/.engine/update.php?tag=<git tag>` URL.
