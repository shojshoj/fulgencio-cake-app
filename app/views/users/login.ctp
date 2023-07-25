<h2>Login</h2>
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

<?php echo $this->Html->link(
    'Register',
    array(
        "controller" => "users",
        "action" => "register"
    ),
    array(
        "class" => "button"
    )
)?>