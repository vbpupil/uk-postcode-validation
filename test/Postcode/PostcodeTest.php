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

        try {
            $this->sut = new Postcode(2);
        } catch (\Exception $e) {
            $this->assertEquals('Non string value passed.', $e->getMessage());
        }
    }

    /**
     *
     */
    public function testEmptyPostcode()
    {

        try {
            $this->sut = new Postcode('');
        } catch (\Exception $e) {
            $this->assertEquals('Empty Postcode.', $e->getMessage());
        }
    }

    /**
     *
     */
    public function testPostcodeIsNotValid()
    {
        try {
            $this->sut = new Postcode('NN00 1234');
        } catch (\Exception $e) {
            $this->assertEquals('Invalid Postcode.', $e->getMessage());
        }
    }

    /**
     *
     */
    public function testPostcodeIsNotRecognised()
    {

        try {
            $this->sut = new Postcode('NB1 7JY');
        } catch (\Exception $e) {
            $this->assertEquals('Non recognised postcode.', $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function testIsHighlandPostcodes()
    {
        $arr = [
            'postcode' => [
                'HS29NP'
            ],
            'head' => [
                'HS2'
            ],
            'tail' => [
                '9NP'
            ],
            'expected_type' => 'SCOTTISH_HIGHLAND'
        ];

        $this->loopPcodes($arr);
    }

    /**
     * @throws Exception
     */
    public function testukMainlandPostcodes()
    {
        $arr = [
            'postcode' => [
                'MK10 1SJ', 'NN 14 P W', 'SW1A1AA'
            ],
            'head' => [
                'MK10', 'NN1','SW1A'
            ],
            'tail' => [
                '1SJ', '4PW','1AA'
            ],
            'expected_type' => 'UK_MAINLAND'
        ];

        $this->loopPcodes($arr);
    }

    /**
     * @throws Exception
     */
    public function testNorthernIrelandPostcodes()
    {
        $arr = [
            'postcode' => [
                'BT11LA', 'BT1 1DA', 'BT1 1ND', 'BT1 1FP', 'BT11EB', 'BT1 1QB', 'BT1 1NE'
            ],
            'head' => [
                'BT1', 'BT1', 'BT1', 'BT1', 'BT1', 'BT1', 'BT1'
            ],
            'tail' => [
                '1LA', '1DA', '1ND', '1FP', '1EB', '1QB', '1NE'
            ],
            'expected_type' => 'NORTHERN_IRE'
        ];

        $this->loopPcodes($arr);
    }

    /**
     * @throws Exception
     */
    public function testIsleOfWhightPostcodes()
    {
        $arr = [
            'postcode' => [
                'PO301NR'
            ],
            'head' => [
                'PO30'
            ],
            'tail' => [
                '1NR'
            ],
            'expected_type' => 'ISLE_OF_WIGHT'
        ];

        $this->loopPcodes($arr);
    }


    /**
     * Used to aid postcode lookup
     *
     * @param $arr
     */
    public function loopPcodes($arr)
    {
        $cnt = 0;

        foreach ($arr['postcode'] as $p) {
            $this->sut = new Postcode($p);
            $this->assertEquals($arr['expected_type'], $this->sut->getType());
            $this->assertEquals($arr['head'][$cnt], $this->sut->getHead());
            $this->assertEquals($arr['tail'][$cnt], $this->sut->getTail());
            $cnt++;
        }
    }
}