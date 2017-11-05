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
            <div class="card mb-3">
                <div class="card-header">
                  <i class="fa fa-bar-chart"></i> User Twitter Histogram Overview</div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100" height="30"></canvas>
                </div>
                <div class="card-footer small text-muted">Based on User Time Zone: <?php echo $userProfile->time_zone; ?></div>
              </div>
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
<?php
/***** X-AXIS LABELS *****/
 $xAxisLabel = array();
 $yAxisValue = array();
 for($i=0; $i<24; $i++):
     $xAxisLabel[$i] = '"'. date('h:i A', strtotime($i .':00')).'"';
     $yAxisValue[$i] = 0;
 endfor;
foreach ($response as $responseVal):
    $date = $responseVal->created_at;
    $date = strtotime($date);
    $hourGiven = date('H', $date);
    //CHECK IF HOUR IS IN ARRAY
    $yAxisValue[intval($hourGiven)]++;
endforeach;

echo max($yAxisValue);
?>
<?php include("views/layout/footer.php"); ?>
<script type="text/javascript">


var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?php echo implode(',', $xAxisLabel);?>],
    datasets: [{
      label: "Number of Tweets",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [<?php echo implode(',', $yAxisValue);?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'hour'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 24
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 15
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});</script>