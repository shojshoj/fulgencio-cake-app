<!-- <h2>Navbar
    <?php 
        // print_r($user);
        // echo $user['id'];
    ?>
    <?php
        // print_r($userinfo);
        echo $userinfo['Userinfo']['first_name'];
    ?>
</h2> -->

<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <?php echo $this->Html->link(
            'FulCake', 
            '/', 
            array(
                "class" => "navbar-brand text-light"
            )
        )?>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navLinks"
            aria-controls="navLinks"
            aria-expanded="false"
            aria-label="Toggle Navigation"
        >
            <span class="navbar-toggler-icon text-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navLinks">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php echo $this->Html->link(
                        'Home',
                        '/',
                        array(
                            "class" => "nav-link active text-light",
                            "aria-current" => "page"
                        )
                    )?>
                </li>
                <li>
                    <?php echo $this->Html->link(
                        'My Posts',
                        array(
                            "user" => true,
                            "controller" => "posts",
                            "action" => "user_index"
                        ),
                        array(
                            "class" => "nav-link active text-light",
                        )
                    )?>
                </li>
            </ul>
        </div>
    </div>
</nav>