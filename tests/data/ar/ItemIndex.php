<?php

namespace yiiunit\sphinx\data\ar;

class ItemIndex extends ActiveRecord
{
    public static function indexName()
    {
        return 'yii2_test_item_index';
    }
}
