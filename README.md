**txp:dml_rand_masthead**

This plugin returns a random masthead image from a given image category.
Upload your mastheads, put them all into some image category, then
put this in your page template or form (substituting your own category name):

	<txp:dml_rand_masthead category="site-masthead" />

Accepts the `linktext="label text"` attribute, which will be used as the ALT
and TITLE tag for the masthead.

Accepts the `class="classname"` attribute, which defines a CSS class for the
masthead.

