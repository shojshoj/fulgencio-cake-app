<h2>All Posts</h2>

<p>
    Hi 
<?php 
    echo $session->read('Auth.User.username'); 
?>
    , You are currently logged in as the Administrator. You can 
<?php 
    echo $html->link(
        'Log out', 
        array(
            'controller' => 'users',
            'action'=>'logout',
            'user' => true
        )
    ); 
?> 
    here.
</p>

<?php if(!$posts): ?>
    <h4>No Posts to Show</h4>
<?php else: ?>
    <!-- <?php print_r($posts)?> -->
    <?php foreach($posts as $post): ?>
        <div class="post-container">
            <div class="post-title">
                <h4><?= $post['Post']['title'];?></h4>
            </div>
            <div class="post-body">
                <p><?= $post['Post']['body'];?></p>
            </div>
            <div class="post-actions">
                <button>View</button>
            </div>
        </div>
    <?php endforeach?>
<?php endif; ?>
