var casper = require('casper').create({
    logLevel:"info",
    verbose:true,
    loadImages: false,
    webSecurityEnabled: false,
    onDie: function(){
        console.log("testing done");
    },
    onPageInitialized: function(){
        console.log('Page Initialized');
    },
});
 
 
casper.userAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.7 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.7');
phantom.cookiesEnabled = true;
casper.viewport = {width: 1366, height: 768};
 
var x = require('casper').selectXPath;

var arg0 = casper.cli.get(0);
var arg1 = casper.cli.get(1);
 
casper.start('http://www.facebook.com/',function(){
    this.sendKeys("#email",arg0);
    this.sendKeys("#pass", arg1);
});
 
casper.thenClick(x('//label[@id="loginbutton"]'),function(){
    this.wait(5000);
    casper.capture("loggato.png");
});

casper.then(function(){

        var name = "";

        this.getElementsInfo(x('//a[@class="fbxWelcomeBoxName"]')).forEach(function(element){
            name = element.text;
        });

        casper.then(function(){
        var fs = require('fs');

        fs.write("name.txt", name, 'w');
        // writing friends list to text file.
        });
});



casper.run()