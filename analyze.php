<?php
/* * ***** VAR AND CONNECTIONS ****** */
require_once('conf.php');

/* * ***** INITIALIZE ****** */
$twitterAnalyzer = new TwitterGet();

/* * ***** GET USER TWEETS ****** */
$response = $twitterAnalyzer->getUserTweets($_GET['twitterUsername']);

$userProfile = $twitterAnalyzer->getUserDetails($_GET['twitterUsername']);
?>
<?php include("views/layout/header.php"); ?>

<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Analysis Result for <quote><?php echo $_GET['twitterUsername']; ?></quote></h1>

        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>User Details</h2>
                <img src="<?php echo $userProfile->profile_image_url; ?>" class="img-responsive img-circle"/>
                <br/>
                <strong><?php echo $userProfile->name; ?></strong>
                <p><?php echo $userProfile->description; ?></p>
                <ul>
                    <li>URL: <?php echo $userProfile->url; ?></li>
                    <li>Location: <?php echo $userProfile->location; ?></li>
                    <li>Followers: <?php echo number_format($userProfile->followers_count); ?></li>
                    <li>Friends: <?php echo number_format($userProfile->friends_count); ?></li>
                    <li>Member Since: <?php echo $userProfile->created_at; ?></li>
                    <li>Time Zone: <?php echo $userProfile->time_zone; ?></li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-bell-o"></i>Tweets</div>
                    <div class="list-group list-group-flush small">
                        <?php foreach ($response as $responseVal):?>
                        <a class="list-group-item list-group-item-action" href="#">
                            <div class="media">
                                <img class="d-flex mr-3 rounded-circle" src="<?php echo $userProfile->profile_image_url; ?>" alt="">
                                <div class="media-body">
                                    <?php echo $responseVal->text;?>
                                    <div class="text-muted smaller"><?php echo $responseVal->created_at;?></div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                        
                        <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
                    </div>
                </div>
                
            </div>
            <div class="col-md-4">
                <?php
                echo "<pre>";
                //print_r($userProfileImage);
                echo "</pre>";
                ?>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

</main>
<?php include("views/layout/footer.php"); ?>