# View page source

To view page source (markdown content), add `?source` query string to the page URL, e.g.:

```
http://www.vurdalakov.net/cms404/sourceview.htm?source
```

To add a "View source" link to the page, insert the following line in the `template.htm`:

```
<a href="$$(PAGE_URL)?source">View source</a>
```
