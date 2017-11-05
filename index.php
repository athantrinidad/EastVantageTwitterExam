<?php include("views/layout/header.php"); ?>

<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">EastVantage Code Examination</h1>
            <p>Write a program which polls the twitter API based on a username and summarises the users last 500 tweets in a histogram. We need to know which hours a user is most active. Please create a repository on bitbucket or github, heroku or openshift (or any other PaaS provider) and send through access instructions. We are interested in viewing the commit history & a working version of your solution.</p>

        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-12">
                <h2>Begin Search</h2>
                <p>Enter twitter username</p>
                <form class="form-inline my-2 my-lg-0" action="analyze.php" method="GET">
                    <input name="twitterUsername" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

</main>

<?php include("views/layout/footer.php"); ?>