<?php
    require ('header.php');
    require ('navbar.php');
?>

    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container">
                <h1 class="masthead-heading mb-0">The way</h1>
                <h2 class="masthead-subheading mb-0">It's meant to be played</h2>
                <?php
                    if(isset($_SESSION['userid']))
                    {
                ?>
                        <a href="games.php" class="btn btn-primary btn-xl rounded-pill mt-5">Games</a>
                        <a href="spotify.php" class="btn btn-primary btn-xl rounded-pill mt-5">Music</a>
                        <a href="discord.php" class="btn btn-primary btn-xl rounded-pill mt-5">Chat</a>
                <?php
                    }
                    else
                    {
                ?>
                        <a href="login.php" class="btn btn-primary btn-xl rounded-pill mt-5">Log in</a>
                <?php
                    }
                ?>
            </div>
        </div>
    </header>

<?php
    //if(isset($_SESSION['userid']))
    //{
        $counter = 0;
        $date = date(DATE_RSS, time());
        $pdo = new PDO('mysql:host=localhost;dbname=arbtop', 'root', '');

        $statement = $pdo->prepare('SELECT * FROM games WHERE DATEDIFF(?, playedLast) < 4');
        if ($statement->execute(array($date)))
        {
            while ($row = $statement->fetch())
            {
                $counter += 1;

                if($counter % 2 == 1)
                {
                ?>
                <section>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-2">
                                <div class="p-5">
                                    <img class="img-fluid rounded-circle" src="<?php $row['img'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-1">
                                <div class="p-5">
                                    <h2 class="display-4"><?php $row['name'] ?></h2>
                                    <p><?php $row['description'] ?></p>
                                    <p class="m-0 small">Zuletzt gespielt: <?php $row['playedLast'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                    <?php
                    }
                    else
                    {
                    ?>
                <section>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <img class="img-fluid rounded-circle" src="<?php $row['img'] ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <h2 class="display-4"><?php $row['name'] ?></h2>
                                    <p><?php $row['description'] ?></p>
                                    <p class="m-0 small">Zuletzt gespielt: <?php $row['playedLast'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                }
            }
        }
    //}
    require ('footer.php');
?>
