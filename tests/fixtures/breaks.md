---
title: "Chrome update equals Behat Fail"
date: 2016-11-07
hero: /images/heros/hero-space.png
menu:
  sidebar:
    name: "Chrome update equals Behat Fail"
    identifier: chrome-update-equals--behat--fail
    weight: -197
tags: [note2self, behat]
---


Had trouble running behat after I ran updates on Chrome

My typical install [https://www.npmjs.com/package/selenium-standalone](https://www.npmjs.com/package/selenium-standalone)

did not fix it, even try `brew` but no luck.

All I needed to do was go [here](https://chromedriver.storage.googleapis.com/index.html?path=2.25/) and grab the lastest one for my Mac. For me this was the 32 bit.

Then after running 

```
selenium-standalone install
``` 

to see where the old one was installed I used that path to unzip this file and move it there ` /usr/local/lib/node_modules/selenium-standalone/.selenium/chromedriver/2.21-x64-chromedriver`

Then started things backup again and it was fine.

```
curl -O https://chromedriver.storage.googleapis.com/2.25/chromedriver_mac64.zip
unzip chromedriver_mac64.zip
mv chromedriver  /usr/local/lib/node_modules/selenium-standalone/.selenium/chromedriver/2.21-x64-chromedriver
```
