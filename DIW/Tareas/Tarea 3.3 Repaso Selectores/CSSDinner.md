## CSS DINER

Práctica para aprender css de manera gráficasa usando como guía [github](https://flukeout.github.io/)

### 1 Select the plates
```css
plate
```

### 2 Select the bento boxes
```css
bento
```

### 3 Select the fancy plate
```css
fancy
```

### 4 Select the apple on the plate
```css
plate>apple
```

### 5 Select the pickle on the fancy plate
```css
#fancy>pickle
```

### 6 Select the small apples
```css
.small
```

### 7 Select the small oranges
```css
orange.small
```

### 8 Select the small oranges in the bentos
```css
bento>orange.small
```

### 9 Select all the plates and bentos
```css
plate, bento
```

### 10 Select all the things!
```css
*
```

### 11 Select everything on a plate
```css
plate>*
```

### 12 Select every apple that's next to a plate
```css
plate + apple
```

### 13 Select the pickles beside the bento
```css
bento ~ pickle
```

### 14 Select the apple directly on a plate
```css
plate>apple
```

### 15 Select the top orange
```css
plate>:first-child
```

### 16 Select the apple and the pickle on the plates
```css
plate>apple:only-child, plate>pickle:only-child
```

### 17 Select the small apple and the pickle
```css
plate>apple.small, pickle
```

### 18 Select the 3rd plate
```css
plate:nth-child(3)
```

### 19 Select the 1st bento
```css
bento:nth-last-child(3)
```

### 20 Select first apple
```css
apple:first-of-type
```

### 21 Select all even plates
```css
plate:nth-of-type(even)
```

### 22 Select every 2nd plate, starting from the 3rd
```css
plate:nth-of-type(2n+3)
```

### 23 Select the apple on the middle plate
```css
plate>apple:only-of-type
```

### 24 Select the last apple and orange
```css
apple:last-of-type, orange:last-of-type
```

### 25 Select the empty bentos
```css
bento:empty
```

### 26 Select the big apples
```css
apple:not(.small)
```

### 27 Select the items for someone
```css
[for]
```

### 28 Select the plates for someone
```css
plate[for]
```

### 29 Select Vitaly's meal
```css
bento[for="Vitaly"]
```

### 30 Select the items for names that start with 'Sa'
```css
[for^="Sa"]
```

### 31 Select the items for names that end with 'ato'
```css
[for$="ato"]
```

### 32 Select the meals for names that contain 'obb'
```css
[for*="obb"]
```