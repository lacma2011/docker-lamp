<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;

require('vendor/autoload.php');

class SeleniumSimpleDbTest extends TestCase
{
protected $driver;

    public function setUp() {
        parent::setUp();


        $host_name = 'selenium';
        $port = 4444;
        $host = 'http://' . $host_name . ':' . $port . '/wd/hub'; // this is the default

        // options for chrome
        $options = new ChromeOptions();
	$options->addArguments(array(
	    '--disable-extensions',
	    '--headless',
	    '--disable-gpu',
	    '--no-sandbox',
	    
        ));
	$caps = DesiredCapabilities::chrome();
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
    
        $this->driver = RemoteWebDriver::create($host, $caps);
    }

    public function testDb() {
        $url = 'http://172.25.0.4';
        $this->driver->get($url);

        // basic check
        $divText = $this->driver->findElement(WebDriverBy::xpath("/html/body/div/h1"))->getText();
        $this->assertEquals("Hi! I'm happy", $divText);

        // db check
        $divText = $this->driver->findElement(WebDriverBy::xpath("/html/body/div/table/tbody/tr[2]/td[3]"))->getText();
        $this->assertEquals("Marc", $divText);
    }

    public function testSimple() {
        $url = 'https://github.com';
        $this->driver->get($url);
        // checking that page title contains word 'GitHub'
        $this->assertContains('GitHub', $this->driver->getTitle());
    }

    public function testToDos() {
        try {
            print "\nNavigating to URL\n";
            $this->driver->get("http://crossbrowsertesting.github.io/todo-app.html");
            sleep(3);
            print "Clicking Checkbox\n";
            $this->driver->findElement(WebDriverBy::name("todo-4"))->click();
            print "Clicking Checkbox\n";
            $this->driver->findElement(WebDriverBy::name("todo-5"))->click();
            $elems = $this->driver->findElements(WebDriverBy::className("done-true"));
            $this->assertEquals(2, count($elems));
            print "Entering Text\n";
            $this->driver->findElement(WebDriverBy::id("todotext"))->sendKeys("Run your first Selenium test");
            print "Adding todo to the list\n";
            $this->driver->findElement(WebDriverBy::id("addbutton"))->click();
            $spanText = $this->driver->findElement(WebDriverBy::xpath("/html/body/div/div/div/ul/li[6]/span"))->getText();
            $this->assertEquals("Run your first Selenium test", $spanText);
            print "Archiving old todos\n";
            $this->driver->findElement(WebDriverBy::linkText("archive"))->click();
            $elems = $this->driver->findElements(WebDriverBy::className("done-false"));
            $this->assertEquals(4, count($elems));
            // if we've made it this far, assertions have passed and we'll set the score to pass.
        } catch (Exception $ex) {
            // if we caught an exception along the way, an assertion failed and we'll set the score to fail.
            print "Caught Exception: " . $ex->getMessage();
        }
    }


    public function tearDown() {
        $this->driver->quit();
        parent::tearDown();
    }

}
