#!/bin/sh
for file in $(find -name "*.php")
do
	iconv --verbose --from-code "ISO-8859-1" --to-code "UTF-8" $file > $file".tmp"
	mv $file".tmp" $file
done
