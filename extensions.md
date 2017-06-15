# cms404 markdown extensions

### Hard line breaks

End a line with two backslashes to insert a hard line break (`<br />`):

```
This is a line before line break.\\
This is a line after line break. And this is an escaped backslash: \\.
```

This is a line before line break.\\
This is a line after line break. And this is an escaped backslash: \\.

### Epigraph

Begin a line with a percent sign (`%`) and a space to format paragraph as an epigraph.

```
% Whenever you find yourself on the side of the majority, it is time to reform (or pause and reflect).\\
- Mark Twain, Notebook, 1904.
```

% Whenever you find yourself on the side of the majority, it is time to reform (or pause and reflect).\\
- Mark Twain, Notebook, 1904.

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

### Backslash Escapes

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
