<?php

return array(
    'name' => 'Blog',           // _wp('Blog')
    'items' => array(
        'posts' => array(
            'name' => 'Wrote posts',      // _wp('Wrote posts')
            'readonly' => true,
            'join' => array(
                'table' => 'blog_post',
                'on' => 'c.id = :table.contact_id'
            ),
            'items' => array(
                'lifetime' => array(
                    'name' => 'Lifetime',           // _wp('Lifetime')
                ),
                ':period' => array(
                    'name' => 'select a period',      // _wp('select a period')
                    'where' => array(
                        ':between' => "DATE(:parent_table.datetime) >= ':0' AND DATE(:parent_table.datetime) <= ':1'",
                        ':gt' => "DATE(:parent_table.datetime) >= ':?'",
                        ':lt' => "DATE(:parent_table.datetime) <= ':?'",
                    )
                )
            ),
            'group_by' => 1
        ),
        'comments' => array(
            'name' => 'Wrote comments',           // _wp('Wrote comments')
            'join' => array(
                'table' => 'blog_comment',
                'on' => 'c.id = :table.contact_id',
            ),
            'multi' => true,
            'items' => array(
                'post' => array(
                    'name' => 'To post',          // _wp('To post')
                    'readonly' => true,
                    'items' => array(
                        ':values' => array(
                            'sql' => 'SELECT id AS value, title AS name FROM blog_post
                        GROUP BY id
                        ORDER BY datetime DESC',
                            'where' => array(
                                '=' => ':parent_table.post_id = :value',
                            )
                        )
                    )
                ),
                'period' => array(
                    'name' => 'Period',           // _wp('Period')
                    'items' => array(
                        ':period' => array(
                            'name' => 'select a period',
                            'where' => array(
                                ':between' => "DATE(:parent_table.datetime) >= ':0' AND DATE(:parent_table.datetime) <= ':1'",
                                ':gt' => "DATE(:parent_table.datetime) >= ':?'",
                                ':lt' => "DATE(:parent_table.datetime) <= ':?'",
                            )
                        )
                    )
                )
            ),
            'group_by' => 1
        ),
    )
);