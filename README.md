# Comics

Comics is a simple [robo.li](https://robo.li/) script which pushes your daily dose of commics into your Slack Channel or HipChat Room.

Currently the following Comics are integrated.

- [Garfield](https://garfield.com/)
- [CommitStrip](http://www.commitstrip.com/en/)
- [Nichtlustig](http://www.nichtlustig.de/)


##### Cronjob settings example
    30 12 * * * php /path/to/your/comics send:comic garfield >> /dev/null 2>&1
    0 9 * * * php /path/to/your/comics send:comic nichtlustig >> /dev/null 2>&1
    0 15 * * * php /path/to/your/comics send:comic commitStrip >> /dev/null 2>&1

##### Issues / Ideas

If you're missing a comic or have any issues, please let me know in the [issues](https://github.com/mhauri/comics/issues/new) section or open a [pull request](https://help.github.com/articles/using-pull-requests) to contribute.


License
-------
[MIT](LICENSE.txt)
