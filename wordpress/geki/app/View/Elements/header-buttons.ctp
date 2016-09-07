<?php
$headerButtons = array();

// ログアウトボタン
$headerButtons[] = 
    $this->Html->link(
        $loginLabel,
        array(
            'controller' => 'login',
            'action' => 'logout'
        ),
        array(
            'class' => array(
                'text-button',
                'logout-button'
            ),
            'escape' => false
        )
    );

// listの再読み込みボタン
$headerButtons[] = 
    $this->Html->link(
        $listLabel,
        array(
            'controller' => 'list',
            'action' => 'index'
        ),
        array(
            'class' => array(
                'text-button',
                'list-button'
            ),
            'escape' => false
        )
    );

// サマリーボタン
//$openFlag = true;
if ($openFlag) {
    $headerButtons[] = 
        $this->Html->link(
            $summaryLabel,
            array(
                'controller' => 'summary',
                'action' => 'index'
            ),
            array(
                'class' => array(
                    'text-button',
                    'summary-button'
                ),
                'escape' => false
            )
        );
}
echo $this->Html->nestedList(
    $headerButtons,
    array(
        'class' => 'header-buttons'
    )
);
