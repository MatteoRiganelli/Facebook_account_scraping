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
    this.wait(3000);
});
 
casper.thenClick(x('//a[@title="Profilo"]'),function(){
    this.wait(3000);
});


//Panoramica 
casper.thenClick(x('//a[@data-tab-key="about"]'),function(){
    this.wait(3000);
});
 
casper.thenClick(x('//a[@data-testid="nav_edu_work"]'),function(){
    casper.wait(3000,function(){
    casper.capture("lavoro_e_istruzione.png");
    });
    
});

casper.run()