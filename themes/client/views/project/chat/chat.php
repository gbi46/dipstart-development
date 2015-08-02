<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 26.06.15
 * Time: 13:54
 */

if(User::model()->isAuthor()) {
    $criteria=new CDbCriteria;
    $criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient='.Yii::app()->user->id.' OR recipient=0)');
    $criteria->addCondition('`order` = :oid');
    $criteria->params[':oid'] = (int) $orderId;
    $messages = ProjectMessages::model()->findAll($criteria);
}
else if(User::model()->isCustomer()) {
    $criteria=new CDbCriteria;
    $criteria->addCondition('(moderated=1 OR sender IN (SELECT userid FROM AuthAssignment WHERE itemname IN ("Admin","Manager")) OR sender='.Yii::app()->user->id.') AND (sender='.Yii::app()->user->id.' OR recipient='.Yii::app()->user->id.' OR recipient=0)');
    $criteria->addCondition('`order` = :oid');
    $criteria->params[':oid'] = (int) $orderId;
    $messages = ProjectMessages::model()->findAll($criteria);
}
else {
    $criteria=new CDbCriteria;
    $criteria->addCondition('`order` = :oid');
    $criteria->params[':oid'] = (int) $orderId;
    $messages = ProjectMessages::model()->findAll($criteria);
}
?>
<div id="chatWindow" class="col-xs-12 chat-view chtpl0-chatblock">
    <!-- Вывод чата -->
    <?php foreach ($messages as $message): ?>
    
    <div class="post chtpl0-msg">
        
        <div class="chtpl0-avatar">
            
            <?php if (User::model()->getUserRole($message->senderObject->id) == 'Author'): ?>
                <button class="toggleexecutor executor-unset"></button>
                <div><?= (int)$message->senderObject->profile->rating ?></div>
            <?php elseif (User::model()->getUserRole($message->senderObject->id) == 'Customer'): ?>
                <button class="chtpl0-user-icon-4 usual-cursor"></button>
            <?php else: ?>
                <button class="chtpl0-user-icon-3 usual-cursor"></button>
            <?php endif; ?>
            
        </div>
        
        <div class="chtpl0-content">
            
            <div class="owner chtpl0-nickname" data-ownerid="<?= $message->senderObject->id ?>">
                <a data-toggle="tooltip" title="<?= $message->senderObject->profile->firstname . ' ' . $message->senderObject->profile->lastname ?>" class="ownerref" href="/user/user/view?id=<?= $message->senderObject->id ?>"><?= $message->senderObject->profile->firstname . ' ' . $message->senderObject->profile->lastname ?></a>  |
            </div>
            <div class="chtpl0-date"><?= $message->date ?></div>
            
            <?php if ($message->cost): ?>
                <div class="cost">Цена за работу: <?= $message->cost ?></div>
            <?php endif; ?>
                
            <div class="text"><?= $message->message ?></div>
        </div>
        
    </div>
    
    
    <?php endforeach; ?>

    <!-- Конец вывода чата -->
</div>
