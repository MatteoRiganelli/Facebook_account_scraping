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
    casper.capture("test1.png");
});
 
casper.thenClick(x('//label[@id="loginbutton"]'),function(){
    casper.wait(5000,function(){
      this.scrollToBottom();
      this.wait(5000);
}).then(function () {
  casper.capture("test2.png");
    
    });
});
 
casper.thenClick(x('//a[@title="Profilo"]'),function(){
    // I have clicked profile name and waiting for 5 sec and storing
    // screenshot.
    casper.wait(5000,function(){
      this.scrollToBottom();
      this.wait(5000);
}).then(function () {
  casper.capture("test3.png");
    
    });
});
 
casper.thenClick(x('//a[@data-tab-key="friends"]'),function(){
    //a specifies thats a link.
    casper.wait(5000,function(){
      this.scrollToBottom();
      this.wait(5000);
}).then(function () {
  casper.capture("test4.png");
    
    });
});
 
casper.then(function(){
        // Here our friends loading page comes.
        // First we are calculating how many friends we have and
        // how many times we have to trigger scroll to bottom event.
        var total = 0;
        this.getElementsInfo(x('//span[@class="_gs6"]')).forEach(function(element){
            total = element.text;
        });
        // so we have a span with class _gs6 to fetch total friends.
        var times=1;
        var times = (total / 20) + 1;
        // simple calculation to find how many times.
        var times = parseInt(times)
        console.log(times);
        for (i = 0; i < times; i++) {
            casper.wait(15000,function(){
            this.scrollToBottom();
            // this trigger scroll to bottom event. i have given the wait
            //time 15 secs because it depends on bandwidth.
            });
        }
        casper.wait(5000,function(){
      this.scrollToBottom();
      this.wait(5000);
}).then(function () {
  casper.capture("final.png");
    
    });
        // here we are capturing the final friends list page.
        casper.then(function(){
        var fs = require('fs');
        // include file system 
        var friends_list = "";
            this.getElementsInfo(x('//div[@class="fsl fwb fcb"]')).forEach(function(element){
                friends_list = friends_list + element.text + "\n";
            });
            // what is this fsl fwb fcb? This is the outer element which
            // holds the friends name. So we are navigating through all
            // such elements and fetching the text value of that element.
            // that’s nothing but friends name list.
        fs.write("friends_list.txt", friends_list, 'w');
        // writing friends list to text file.
        });

 
});

casper.thenClick(x('//a[@data-tab-key="friends"]'),function(){
    //a specifies thats a link.
    casper.wait(5000,function(){
      this.scrollToBottom();
      this.wait(5000);
}).then(function () {
  casper.capture("test4.png");
    
    });
});

casper.run()