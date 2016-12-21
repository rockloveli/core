<?php
/**
 * @author Tom Needham
 * @copyright 2016 Tom Needham tom@owncloud.com
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace Tests\Settings\Panels\Legacy;

use OC\Settings\Panels\Personal\Legacy;

/**
 * @package Tests\Settings\Panels\Personal
 */
class LegacyTest extends \Test\TestCase {

	/** @var \OC\Settings\Panels\Personal\Legacy */
	private $panel;

	public function setUp() {
		parent::setUp();
        $this->helper = $this->getMockBuilder('\OC\Settings\Panels\Helper')->getMock();
		$this->panel = new Legacy($this->helper);
	}

	public function testGetSection() {
		$this->assertEquals('additional', $this->panel->getSectionID());
	}

	public function testGetPriority() {
		$this->assertTrue(is_integer($this->panel->getPriority()));
		$this->assertTrue($this->panel->getPriority() < 50);
        $this->assertTrue($this->panel->getPriority() > -50);
	}

	public function testGetPanel() {
        $this->helper->expects('getPersonalForms')->once()->willReturn([
            [
                'page' => 'form 1'
            ],
            [
                'page' => 'form 2'
            ]
        ]);
		$templateHtml = $this->panel->getPanel()->render();
		$this->assertContains('form 1', $templateHtml);
        $this->assertContains('form 2', $templateHtml);
	}

}
