var casper = require('casper').create({
    logLevel:"info",
    verbose:true,
    loadImages: true,
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
casper.viewport = {width: 1366, height: 3000};
 
var x = require('casper').selectXPath;
 
casper.start('http://www.facebook.com/',function(){
    this.sendKeys("#email","matteoriganelli@gmail.com");
    this.sendKeys("#pass","dududu");
});
 
casper.thenClick(x('//label[@id="loginbutton"]'),function(){
    casper.wait(5000,function(){
      this.scrollToBottom();
      this.wait(5000);
      this.scrollToBottom();
      this.wait(5000);
      this.scrollToBottom();
}).then(function () {
  casper.capture("post_bacheca.png");
    
    });
});
 



casper.run()