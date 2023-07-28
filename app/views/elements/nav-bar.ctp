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
        <div class="collapse navbar-collapse navbar-dark" id="navLinks">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php echo $this->Html->link(
                        'Home',
                        '/',
                        array(
                            "class" => "nav-link",
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
                            "class" => "nav-link",
                        )
                    )?>
                </li>
            </ul>
            <span>
                <a
                    class="btn" 
                    href="https://github.com/shojshoj"
                    style="color:white;"
                    target="_blank"
                >
                    <i class="bi bi-github"></i>
                </a>
            </span>
            <span class="dropdown">
                <button
                    class="btn" 
                    href="#" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false" 
                    style="color:white;"
                >
                    <i class="bi bi-person-fill"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end text-end">
                    <?php if(!empty($user)):?>
                        <li>
                            <?php echo $this->Html->link(
                                'My Posts',
                                array(
                                    "controller" => "posts",
                                    "action" => "index",
                                    "user" => true,
                                ),
                                array(
                                    "class" => "dropdown-item",
                                )
                            )?>
                        </li> 
                        <li>
                            <?php echo $this->Html->link(
                                'My Account',
                                array(
                                    "controller" => "users",
                                    "action" => "view",
                                    "user" => true,
                                ),
                                array(
                                    "class" => "dropdown-item",
                                )
                            )?>
                        </li> 
                        <li>
                            <?php echo $this->Html->link(
                                'Logout',
                                array(
                                    "controller" => "users",
                                    "action" => "logout",
                                    "user" => true,
                                ),
                                array(
                                    "class" => "dropdown-item",
                                )
                            )?>
                        </li>
                    <?php else: ?>
                        <li>
                            <?php echo $this->Html->link(
                                'Register',
                                array(
                                    "controller" => "users",
                                    "action" => "register",
                                    "user" => false,
                                ),
                                array(
                                    "class" => "dropdown-item",
                                )
                            )?>
                        </li>   
                    <?php endif; ?>
                </ul>
            </span>
        </div>
    </div>
</nav>