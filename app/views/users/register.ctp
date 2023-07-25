<h2>Register</h2>

<?php
echo $this->Form->create(
    'User',
    array(
        'action' => 'register',
        'novalidate' => array(),
        'class' => 'needs-validation',
    )
);

echo $this->Form->input(
    'username',
    array(
        'placeholder' => 'Enter Username Here',
        'div' => 'forDiv',
        'class' => 'form-control forInput',
        'label' => array(
            'text' => "Username",
            'class' => 'form-label forLabel'
        ),
        'required' => true
    )
);
?>

<label for="validationCustom01" class="form-label">First name</label>
<input type="text" class="form-control" id="validationCustom01" value="Mark" required>

<?php 
    echo $this->Form->input('password');
    echo $this->Form->input('password_confirm');
?>

<span class = "invalid-feedback">
    <?php
        echo $this->Session->flash();
        echo $this->Session->flash('auth');
    ?>
</span>

<div class="col-12">
    <button class="btn btn-primary" type="submit">Register</button>
</div>

<?php echo $this->Html->link(
    'Login',
    array(
        "controller" => "users",
        "action" => "login"
    ),
    array(
        "class" => "button"
    )
)?>