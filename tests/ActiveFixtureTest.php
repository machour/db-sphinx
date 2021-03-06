<?php

namespace yiiunit\sphinx;

use yii\sphinx\ActiveFixture;
use yii\test\FixtureTrait;
use yiiunit\sphinx\data\ar\ActiveRecord;
use yiiunit\sphinx\data\ar\RtIndex;
use yiiunit\sphinx\data\fixture\MySphinxTestCase;
use yiiunit\sphinx\data\fixture\RtIndexFixture;

class ActiveFixtureTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        \Yii::$app->set('sphinx', $this->getConnection());
        ActiveRecord::$db = $this->getConnection();
    }

    public function testGetData()
    {
        $test = new MySphinxTestCase();
        $test->setUp();
        $fixture = $test->getFixture('runtimeIndex');
        $this->assertEquals(RtIndexFixture::class, get_class($fixture));
        $this->assertEquals(2, count($fixture));
        $this->assertEquals(1, $fixture['row1']['id']);
        $this->assertEquals('title1', $fixture['row1']['title']);
        $this->assertEquals(2, $fixture['row2']['id']);
        $this->assertEquals('title2', $fixture['row2']['title']);
        $test->tearDown();
    }

    public function testGetModel()
    {
        $test = new MySphinxTestCase();
        $test->setUp();
        $fixture = $test->getFixture('runtimeIndex');
        $this->assertEquals(RtIndex::class, get_class($fixture->getModel('row1')));
        $this->assertEquals(1, $fixture->getModel('row1')->id);
        $this->assertEquals(1, $fixture->getModel('row1')->type_id);
        $this->assertEquals(2, $fixture->getModel('row2')->id);
        $this->assertEquals(2, $fixture->getModel('row2')->type_id);
        $test->tearDown();
    }
}
