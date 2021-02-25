# Comics

Comics is a simple [robo.li](https://robo.li/) script which pushes your daily dose of commics into your Microsoft Teams and/or Slack Channel.

The following Comics are currently integrated.

- [Garfield](https://garfield.com/)
- [CommitStrip](http://www.commitstrip.com/en/)
- [Nichtlustig](http://www.nichtlustig.de/)
- [xkcd](https://www.xkcd.com/)
- [Dilbert](https://www.dilbert.com/)
- [Unnützes Wissen](https://www.xn--unntzes-wissen-isb.de/)

##### Installation
    composer create-project mhauri/comics-to-webhooks comics

##### Configuration
    cp .env.dist .env

Configure your Microsoft Teams / Slack Webhook Url's in the **.env** file.


##### Cronjob settings example
    30 12 * * * php /path/to/your/comics send:comic garfield >> /dev/null 2>&1
    0 9 * * * php /path/to/your/comics send:comic nichtlustig >> /dev/null 2>&1
    0 15 * * * php /path/to/your/comics send:comic commitStrip >> /dev/null 2>&1
    30 16 * * * php /path/to/your/comics send:comic xkcd >> /dev/null 2>&1
    30 10 * * * php /path/to/your/comics send:comic dilbert >> /dev/null 2>&1
    30 11 * * * php /path/to/your/comics send:comic unnuetz >> /dev/null 2>&1

##### Issues / Ideas

If you're missing a comic or have any issues, please let me know in the [issues](https://github.com/mhauri/comics/issues/new) section or open a [pull request](https://help.github.com/articles/using-pull-requests) to contribute.


License
-------
[MIT](LICENSE.txt)
