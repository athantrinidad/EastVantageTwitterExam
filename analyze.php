<?php
/******* VAR AND CONNECTIONS *******/
require_once('conf.php');

/******* INITIALIZE *******/
$twitterAnalyzer = new TwitterGet();

/******* GET USER TWEETS *******/
$response = $twitterAnalyzer->getUserTweets();

?>
<?php include("views/layout/header.php"); ?>

<main role="main">

            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Analysis Result for <quote><?php echo $_GET['twitterUsername'];?></quote></h1>
                    
                </div>
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Begin Search</h2>
                        <p>Enter twitter username</p>
                        <?php
                        foreach($response as $responseVal):
                            echo $responseVal->created_at . " - ".$responseVal->text."<br/>";
                        endforeach;
                        ?>
                    </div>
                    <div>
                        <?php
                        echo "<pre>";
                        //print_r(json_decode($response));
                        echo "</pre>";
                        ?>
                    </div>
                </div>

                <hr>

            </div> <!-- /container -->

        </main>
<?php include("views/layout/footer.php"); ?>