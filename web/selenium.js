var webdriver = require('selenium-webdriver');
var chrome = require('selenium-webdriver/chrome');
var path = require('chromedriver').path;

var service = new chrome.ServiceBuilder(path).build();
chrome.setDefaultService(service);

var driver = new webdriver.Builder()
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
El.sendKeys("/home/mlottit/upra_data_numero_tva");
El.submit();
//driver.findElement(webdriver.By.name('submit-test')).click();

//driver.quit();
