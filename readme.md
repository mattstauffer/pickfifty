# Pick Fifty

Recently my publisher told me I had 50 free eBook copies of [Laravel: Up and Running](https://laravelupandrunning.com/) to give away for advance readers. I set up a Google Form and got 458 submissions.

Now, I had to pick 50. I downloaded a CSV from the form and read them all and marked the first column with an `x` if their reason for wanting to read the book was compelling, and then I also sprinkled a few more `x's` just to make sure I had a solid amount of people at varying ability levels. That left me with 84 people.

Then I wrote [this quick PickFifty](https://github.com/mattstauffer/pickfifty/blob/master/app/Console/Commands/PickFifty.php) command that reads the CSV, filters it, and then saves it.

This task doesn't need Laravel, but it was literally faster to make it in Laravel than it was to fuss with setting up console commands and filesystem access and Composer. Which is stupid. But it's true.
