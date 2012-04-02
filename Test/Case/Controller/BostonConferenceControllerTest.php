<?php

/**
 * Test class for the BostonConferenceController and BostonConferenceAppController.
 */
class BostonConferenceControllerTest extends ControllerTestCase {

/**
 * Test the BostonConferenceController::index() method.
 *
 * @return void
 */
    public function testIndex() {
        $this->testAction('/boston_conference/boston_conference/index');
    }

/**
 * Test that the navigation variables are set before rendering happens.
 *
 * @return void
 */
    public function testNavigation() {
        $result = $this->testAction('/boston_conference/boston_conference/index',array('return' => 'vars'));
	$this->assertTrue(array_key_exists('navigation_links',$result));
	$this->assertInternalType('array',$result['navigation_links']);
	$this->assertTrue(count($result['navigation_links']) > 0);
    }

}
