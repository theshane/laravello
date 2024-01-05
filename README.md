# Laravello

This is me tinkering with laravel while also figureing out HTMX and the capabilities of using it with No build Javascript


## This was all done with HTML, HTMX and minimal JS. I have linked the relevant files below the image

![larevello](https://github.com/theshane/laravello/assets/101554/ed9095e9-c138-400a-8f98-3ac728076d99)

### Here is the js file for handling the dragging and dropping
https://github.com/theshane/laravello/blob/main/src/public/app.js

### Here are the blade template files with the htmx tags
https://github.com/theshane/laravello/blob/main/src/resources/views/fragments/board.blade.php

https://github.com/theshane/laravello/blob/main/src/resources/views/fragments/dashboard.blade.php

## Lessons

1. This is a pretty efficient and fun way to build a web app
2. You will need to think about how you can make the JS more testable and maintainable if this were in a larger production application. 
3. HTMX is pretty easy to use but there is a paradigm shift that will slow you down a bit if you are coming from React or Vue.
4. I am not quite sure how I would handle calendars and other JS heavy components yet
5. I like PHP, I am going to be honest. I always love coming back to it :)

 ## Misc notes
 Please do not confuse this for what I would consider production code it was just a toy and I may come back to add tests and stuff to make it a real portfolio project but I was just learning and wanted to keep it around in case I want to look at it in the future or it helps others.
