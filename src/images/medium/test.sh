#!/bin/bash

# Loop through all JPEG files in the current directory and convert them to WebP
for file in *.jpg; do
    cwebp -q 89 "$file" -o "${file%.*}.webp"
done

echo "Conversion complete"
