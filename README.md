# cms404

**cms404** is a very simple static content management system for building websites out of [markdown](https://daringfireball.net/projects/markdown/) files.

Written in PHP5 language. Does not use databases.

### Features

- Markdown syntax of content files, supports [GitHub flavored markdown](https://help.github.com/categories/writing-on-github/).
- [Macros](customization.md) in markdown files.
- Content files can be stored in a directory structure.
- Designed to be updated from a Git repository.
- Automatically changes `.md` extensions to `.htm` in site URLs.

### Quick start

#### Without using Git repository

1. Download this repository content.
1. Replace `.md` files with your own content.
1. [Customize](customization.md) `template.htm`, `default.css` and `.config` files to follow your needs.
1. Upload repository content to any place of your site.

#### Using Git repository

1. Fork this repository.
1. Replace `.md` files with your own content.
1. [Customize](customization.md) `template.htm`, `default.css` and `.config` files to follow your needs.
1. Set `$gitTag` property (any URL-encoded string) in `.config` file.
1. Clone your repository to your site (e.g. using SSH).
1. Configure deployment key in Git repository and copy it to your web site.
1. Configure webhook in Git repository to POST to `<your site root>/.engine/update.php?tag=<git tag>` URL.

### Acknowledgements

- [Parsedown](http://parsedown.org/) markdown parser in PHP.
- [github-markdown-css](https://github.com/sindresorhus/github-markdown-css): the minimal amount of CSS to replicate the GitHub Markdown style.
- [Wikitten]: a small, fast, PHP wiki.

### License

Distributed under the terms of the [MIT license](https://opensource.org/licenses/MIT).

### Disclaimer

```
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```
