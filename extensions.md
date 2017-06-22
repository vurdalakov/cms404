# cms404 markdown extensions

cms404 markdown extensions are located in the `.engine/ParsedownExtensions.php` file.

You can use it in your own project:

```
$text = file_get_contents('index.md');
$parsedown = new ParsedownExtensions();
echo $parsedown->text($text);
```

## Hard line breaks

End a line with two backslashes to insert a hard line break (`<br />`):

```
This is a line before line break.\\
This is a line after line break. And this is an escaped backslash: \\.
```

This is a line before line break.\\
This is a line after line break. And this is an escaped backslash: \\.

## Epigraph

Begin a line with a percent sign (`%`) and a space to format paragraph as an epigraph.

```
% Whenever you find yourself on the side of the majority,
it is time to reform (or pause and reflect).\\
- Mark Twain, Notebook, 1904.
```

% Whenever you find yourself on the side of the majority,
it is time to reform (or pause and reflect).\\
- Mark Twain, Notebook, 1904.

The script above is rendered as following:

```
<p class="pde-epigraph">Whenever you find yourself on the side of the majority,
it is time to reform (or pause and reflect).<br />
- Mark Twain, Notebook, 1904.</p>
```

`pde-epigraph` style is defined in `.custom/template.htm` file, you can modify it as you wish:

```
.pde-epigraph {
    padding-left: 60%;
}
```

Epigraphs has all the features of a paragraph. They can be multiline, have inline formatting, etc.

```
% _Washington, April 12, 1961, 1:24 p.m._

The people of the United States share with the people of the Soviet Union their satisfaction
for the safe flight of the astronaut in man's first venture into space. We congratulate you
and the Soviet scientists and engineers who made this feat possible. It is my sincere desire
that in the continuing quest for knowledge of outer space our nations can work together to
obtain the greatest benefit to mankind.

% **John F. Kennedy**\\
President of
the United States
```

% _Washington, April 12, 1961, 1:24 p.m._

The people of the United States share with the people of the Soviet Union their satisfaction
for the safe flight of the astronaut in man's first venture into space. We congratulate you
and the Soviet scientists and engineers who made this feat possible. It is my sincere desire
that in the continuing quest for knowledge of outer space our nations can work together to
obtain the greatest benefit to mankind.

% **John F. Kennedy**\\
President of
the United States

## Backslash Escapes

The colon (`:`) and the percent sign (`%`) are added to the list of characters you can escape using a backslash.
With this you can prevent them from triggering a definition list or an epigraph.

```
Definition
: This is a definition.

Not a definition
\: This is not a definition.

% This is an epigraph

\% This is not an epigraph

Special characters: \\ \- \: \% \+
```

Definition
: This is a definition.

Not a definition
\: This is not a definition.

% This is an epigraph

\% This is not an epigraph

Special characters: \\ \- \: \% \+

## Image alignment

Ending image `alt` attribute text with a space and one or two angle blackets aligns image to the left (` <`), right (` >`) or center (` <>`).

```
![Default alignment](sample.png)
![Right-aligned >](sample.png)
![Left-aligned <](sample.png)
![Centered <>](sample.png)
```

![Default alignment](sample.png)
![Right-aligned >](sample.png)
![Left-aligned <](sample.png)
![Centered <>](sample.png)

The script above is rendered as following:

```
<img src="sample.png" alt="Default alignment" title="Alt text" />
<img src="sample.png" alt="Right-aligned" class="pde-img-right" />
<img src="sample.png" alt="Left-aligned" class="pde-img-left" />
<img src="sample.png" alt="Centered" class="pde-img-center" />
```

`pde-` styles are defined in `.custom/template.htm` file, you can modify them as you wish:

```
.pde-img-left {
    float: left;
    margin-right: 8px;
}
.pde-img-right {
    float:right;
    margin-left: 8px;
}
.pde-img-center {
    display: block;
    max-width: 100%;
    height: auto;
    margin: auto;
    float: none!important;
}
```

## Image title

img attribute is added to image, with the same value as alt attribute.

```
![Image text](sample.png)
```

```
<img src="sample.png" alt="Image text" title="Image text" />
```

Place mouse cursor over the image to see image tooltip:

![Image text](sample.png)
