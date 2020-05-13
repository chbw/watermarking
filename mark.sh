#!/bin/bash
TMPDIR=$(mktemp -d)
trap "rm -rf $TMPDIR" EXIT
convert -alpha off -colorspace RGB -density 150 "$1" "$TMPDIR/part.png"
for page in $TMPDIR/part-*.png; do 
	composite -dissolve 55 -gravity center watermark.png -colorspace RGB ${page} ${page%.*}-wm.png
done
convert `ls -v $TMPDIR/part*-wm.png` "$TMPDIR/open.pdf"
qpdf --encrypt 'Vervielfaeltigung und Verbreitung nach Paragraph 42 (6) Urheberrechtsesetz nicht zulaessig.' ih6eecheejiengoomoo7ye3ohshisoZi5toh3aif 256 \
	--extract=n --print=none --modify=none -- \
	"$TMPDIR/open.pdf" "$TMPDIR/protected.pdf"
cat "$TMPDIR/protected.pdf"
