# cms404

**cms404** is a very simple static content management system (CMS) for building websites out of [markdown](https://en.wikipedia.org/wiki/Markdown) files.

## Features

- [Markdown syntax](https://daringfireball.net/projects/markdown/syntax) of content files, with support of [GitHub flavored markdown](https://help.github.com/categories/writing-on-github/) and [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).
- Experimental [markdown extensions](extensions.md).
- [Macros](macros.md) in template and markdown files.
- Written in PHP5 language.
- Does not use databases. Content plain text files are stored in a directory structure.
- Designed to be updated from a Git repository. However you can also use FTP etc.
- Automatically changes `.md` extensions to `.htm` in site URLs.
- [View page source](sourceview.md) (markdown content).

## Documentation

- [Quick start](quick.md)
- [Known problems and solutions](solutions.md)\\
&nbsp;
- [Macros](macros.md)
- [Site, folder and file properties](properties.md)
- [Experimental markdown extensions](extensions.md)
- [View page source](sourceview.md)

## Acknowledgements

- [Parsedown](http://parsedown.org/) markdown parser in PHP.
- [Parsedown Extra](https://github.com/erusev/parsedown-extra) extension.
- [github-markdown-css](https://github.com/sindresorhus/github-markdown-css): the minimal amount of CSS to replicate the GitHub Markdown style.
- [Fork me on GitHub CSS ribbon](https://github.com/simonwhitaker/github-fork-ribbon-css).

## Inspiration

- [Twig](https://twig.sensiolabs.org/): a flexible, fast, and secure template engine for PHP.
- [Wikitten](https://wikitten.vizuina.com/): a small, fast, PHP wiki.

## License

Distributed under the terms of the [MIT license](https://opensource.org/licenses/MIT).

## Disclaimer

```
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```
