<?php
/**
 * PostcodeTest.php
 *
 * @author: Dean Haines
 * @copyright: Dean Haines, 2018, UK
 * @license: MIT See LICENSE.md
 */

namespace Test\vbpupil\Postcode;

use Exception;
use PHPUnit\Framework\TestCase;
use vbpupil\Postcode\Postcode;


/**
 * Class PostcodeTest
 * @package Test\vbpupil
 */
class PostcodeTest extends TestCase
{
    /**
     * @var
     */
    public $sut;

    /**
     *
     */
    public function testPassedValueIsString()
    {

        try{
            $this->sut = new Postcode(2);
        }catch(\Exception $e){
            $this->assertEquals('Non string value passed.', $e->getMessage());
        }
    }

    /**
     *
     */
    public function testEmptyPostcode()
    {

        try{
            $this->sut = new Postcode('');
        }catch(\Exception $e){
            $this->assertEquals('Empty Postcode.', $e->getMessage());
        }
    }

    /**
     *
     */
    public function testPostcodeIsNotValid()
    {
        try{
            $this->sut = new Postcode('NN00 1234');
        }catch(\Exception $e){
            $this->assertEquals('Invalid Postcode.', $e->getMessage());
        }
    }

    /**
     *
     */
    public function testPostcodeIsNotRecognised()
    {

        try{
            $this->sut = new Postcode('NB1 7JY');
        }catch(\Exception $e){
            $this->assertEquals('Non recognised postcode.', $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function testIsHighlandPostcodes()
    {
        $codes = [
            'HS2 9NP'
        ];

        $this->loopPcodes($codes, 'SCOTTISH_HIGHLAND');
    }

    /**
     * @throws Exception
     */
    public function testukMainlandPostcodes()
    {
        $codes = [
            'mk10 1SJ', 'nn14 pw'
        ];

        $this->loopPcodes($codes, 'UK_MAINLAND');
    }

    /**
     * @throws Exception
     */
    public function testNorthernIrelandPostcodes()
    {
        $codes = [
            'BT11LA','BT1 1DA','BT1 1ND','BT1 1FP','BT11EB','BT1 1QB','BT1 1NE'
        ];

        $this->loopPcodes($codes, 'NORTHERN_IRE');
    }

    /**
     * @throws Exception
     */
    public function testIsleOfWhightPostcodes()
    {
        $codes = [
            'PO301NR'
        ];

        $this->loopPcodes($codes, 'ISLE_OF_WIGHT');
    }


    /**
     * Used to aid postcode lookup
     *
     * @param $arr
     * @param $expectedType
     * @throws Exception
     */
    public function loopPcodes($arr, $expectedType)
    {

        foreach ($arr as $p){
            $this->sut = new Postcode($p);
            $this->assertEquals($expectedType, $this->sut->getType());
        }
    }
}
