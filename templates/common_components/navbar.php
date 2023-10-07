<header class="col-12">
    <nav class="navbar navbar-dark bg-dark" aria-label="Eighth navbar example">
      <?php
      if(isset($_SESSION["user_id"])){
        $location = "?command=home";
      }else{
        $location = "?command=landing";
      }
      ?>
        <a class="navbar-brand" href=<?=$location?>> <H1> Trivia Game </H1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsTop" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsTop">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                        foreach ($navlinks as $text => $link)
                            echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=" . $link . ">" . $text . "</a> </li>";
                    ?>
                </ul>
            </div>
    </nav>

</header>
