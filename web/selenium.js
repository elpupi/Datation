var webdriver = require('selenium-webdriver');
var chrome = require('selenium-webdriver/chrome');
var firefox = require('selenium-webdriver/firefox');
var path = require('chromedriver').path;

var service = new chrome.ServiceBuilder(path).build();
chrome.setDefaultService(service);

var driver = new webdriver.Builder()
//    .withCapabilities(webdriver.Capabilities.firefox())
    .withCapabilities(webdriver.Capabilities.chrome())
    .build();

/*driver.get('http://www.google.com');
driver.findElement(webdriver.By.name('q')).sendKeys('webdriver');
driver.findElement(webdriver.By.name('btnG')).click();
driver.wait(function() {
 return driver.getTitle().then(function(title) {
   return title === 'webdriver - Google Search';
 });
}, 1000);
*/

driver.get('http://localhost/Timeland/web/app_dev.php/timeland');
var El = driver.findElement(webdriver.By.id("fileToUpload"));
El.sendKeys("/home/milottit/Images/Octobre_2014/Natasha/IMG_2276.JPG");
El.submit();
//driver.findElement(webdriver.By.name('submit-test')).click();
//driver.wait(function() {
//return false; }, 100000);

driver.quit();
