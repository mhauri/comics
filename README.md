[![Build Status](https://img.shields.io/travis/com/mhauri/comics?style=flat-square)](https://travis-ci.com/mhauri/comics)
[![Codacy Badge](https://img.shields.io/codacy/grade/c47c9b60b7814823acd8627dce23ba31?style=flat-square)](https://www.codacy.com/gh/mhauri/comics/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=mhauri/comics&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://img.shields.io/codacy/coverage/c47c9b60b7814823acd8627dce23ba31?label=code%20coverage&style=flat-square)](https://www.codacy.com/gh/mhauri/comics/dashboard?utm_source=github.com&utm_medium=referral&utm_content=mhauri/comics&utm_campaign=Badge_Coverage)

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
