<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;


class FeatureContext implements Context, SnippetAcceptingContext
{

private $shelf;
private $basket;
protected $webDriver;
protected $baseUrl;

public function __construct()
{
    $this->shelf = new Shelf();
    $this->basket = new Basket($this->shelf);
    $this->baseUrl = 'https://www.google.de';
}



    /**
     * @Given I have a web browser
     */
    public function iHaveAWebBrowser()
    {

    }

    /**
     * @When I load the homepage
     */
    public function iLoadTheHomepage()
    {
     $this->webDriver->get($this->baseUrl .'/');
    }


    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        throw new PendingException();
    }

    /**
     * @param BeforeScenarioScope $event
     */
    public function openWebBrowser(BeforeScenarioScope $event){
        $capabilities = DesiredCapabilities::firefox();
        $host = 'http://localhost:4444/wd/hub';
        $this->webDriver = RemoteWebDriver::create($host,$capabilities::firefox());

    }

    public function closeWebBroser(AfterScenarioScope $event){
       // if($this->webDriver) $this->webDriver->
    }

/************************************************************/

/**
 * @Given there is a :product, which costs £:price
 */
public function thereIsAWhichCostsPs($product, $price)
{
    $this->shelf->setProductPrice($product, floatval($price));
}

/**
 * @When I add the :product to the basket
 */
public function iAddTheToTheBasket($product)
{
    $this->basket->addProduct($product);
}

/**
 * @Then I should have :count product(s) in the basket
 */
public function iShouldHaveProductInTheBasket($count)
{
    PHPUnit_Framework_Assert::assertCount(
        intval($count),
        $this->basket
    );
}

/**
 * @Then the overall basket price should be £:price
 */
public function theOverallBasketPriceShouldBePs($price)
{
    PHPUnit_Framework_Assert::assertSame(
        floatval($price),
        $this->basket->getTotalPrice()
    );
}

}