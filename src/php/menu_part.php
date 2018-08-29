<nav>
    <div class="nav-wrapper">
        <span class="brand-logo">Love Letter Archive</span>
        
        <ul id="nav-mobile" class="right">
            <li <?php if($currentPage == "scores"){ echo 'class="active"';} ?> >
                <a href="./index.php">Scores</a>
            </li>
            <li <?php if($currentPage == "stats"){ echo 'class="active"';} ?> >
                <a href="./stats.php">Stats</a>
            </li>
            <li <?php if($currentPage == "cards"){ echo 'class="active"';} ?> >
                <a href="./cards.php">Cards</a>
            </li>
        </ul>
    </div>
</nav>
