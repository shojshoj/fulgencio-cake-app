<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');

?>
<?php
    echo $this->Session->flash();
    echo $this->Session->flash('auth');
?>
<?php
echo $this->Form->end('Login');
?>