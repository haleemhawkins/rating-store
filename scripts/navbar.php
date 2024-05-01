<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
        <a href="../index.php" class="w3-bar-item w3-button"><b>EZ</b> Rating</a>
        <!-- Float links to the right. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
            <?php
            if(isAdmin()) {
                echo '<a href="../admin_view_page.php" class="w3-bar-item w3-button">Admin</a>';
            }
            ?>

            <div class="w3-dropdown-hover">
                <a href="#" class=" w3-button w3-white">Categories</a>
                <div class="w3-dropdown-content w3-bar-block w3-white w3-card-4">
                    <a href="../product_page.php?tag=Electronics" class="w3-bar-item w3-button">Electronics</a>
                    <a href="../product_page.php?tag=office equipment" class="w3-bar-item w3-button">office equipment</a>
                    <a href="../product_page.php?tag=cosmetics" class="w3-bar-item w3-button">cosmetics</a>
                    <a href="../product_page.php?tag=Fashion" class="w3-bar-item w3-button">Fashion</a>
                    <a href="../product_page.php?tag=Furniture" class="w3-bar-item w3-button">Furniture</a>
                    <a href="../product_page.php?tag=Tools" class="w3-bar-item w3-button">Tools</a>
                    <a href="../product_page.php?tag=Appliances" class="w3-bar-item w3-button">Appliances</a>
                    <a href="../product_page.php?tag=Toys" class="w3-bar-item w3-button">Toys</a>
                </div>
            </div>

            <a href="../AboutPage/AboutPage.php" class="w3-bar-item w3-button">About</a>
            <?php
            if(isset($_SESSION['email'])) {
                echo '<a href="../Login_Signup/logout.php" class="w3-bar-item w3-button w3-black w3-hover-yellow w3-round-xxlarge">Log off</a>';
            } else {
                echo '<a href="../Login_Signup/login.html" class="w3-bar-item w3-button w3-black w3-hover-yellow w3-round-xxlarge">Log in / sign up</a>';
            }
            ?>
        </div>
    </div>
</div>