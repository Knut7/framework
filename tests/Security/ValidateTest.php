<?php
/**
 * KNUT7 K7F (http://framework.artphoweb.com/)
 * KNUT7 K7F (tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2015.  KNUT7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.2
 */

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 17/10/17
 * Time: 11:54
 */

use Ballybran\Helpers\Security\Val;
use Ballybran\Helpers\Security\Validate;
use PHPUnit\Framework\TestCase as PHPUnit;


class ValidateTest extends PHPUnit
{
    private $valid;
    private $val;

    public function setUp()
    {
        $this->val = new Val();
        $this->valid = new Validate();
    }

    public function testValidIMethod()
    {
        $this->valid->setMethod("POST");
        $this->assertEquals("POST", $this->valid->getMethod());
    }

    public function testValidInputPost()
    {
        $_POST["firstname"] = "John";
        $_POST["lastname"] = "Doe";
        $_POST["email"] = "johnDoe@gmail.com";
        $_POST["telephone"] = 244913750140;

        $this->valid->setMethod("POST");
        $this->valid->getMethod();

        $this->valid->post('firstname')->val("maxlength", 12)
            ->post('lastname')->val('maxlength', 20)
            ->post('email')->val('minlength', 5)
            ->post('telephone')->val('digit')->submit();
        $this->assertEquals(["firstname" => "John", "lastname" => "Doe", "email" => "johnDoe@gmail.com", "telephone" => 244913750140], $this->valid->getPostData());


    }

    public function testValidInputGet()
    {
        $_GET["firstname"] = "John";
        $_GET["lastname"] = "Doe";
        $_GET["email"] = "johnDoe@gmail.com";
        $_GET["telephone"] = 244913750140;

        $this->valid->setMethod("GET");
        $this->valid->getMethod();

        $this->valid->post('firstname')->val("maxlength", 12)
            ->post('lastname')->val('maxlength', 20)
            ->post('email')->val('minlength', 17)
            ->post('telephone')->val('digit')->submit();
        $this->assertEquals(["firstname" => "John", "lastname" => "Doe", "email" => "johnDoe@gmail.com", "telephone" => 244913750140], $this->valid->getPostData());

    }

    public function testIfValIsInstanceOfValidate()
    {

        $this->assertInstanceOf(Ballybran\Helpers\Security\Val::class, $this->val);

    }
}
