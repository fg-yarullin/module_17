<!--<footer class="grid-item copyright_social">-->

    <h3><?php echo $name . ' ' . $surname ?></h3>

    <p>
        <?php
            $year = 2020;
            $date = date('Y') > $year ? date ('Y') : $year;
            echo '&copy' . $year . ' &#x2212; '. $date . '. Все права защищены.';
        ?>
    </p>

    <div class="social_logo">
        <img src="../img/vk-social-network-logo.png" alt="vk-logo">
        <img src="../img/vk-social-network-logo.png" alt="vk-logo">
        <img src="../img/vk-social-network-logo.png" alt="vk-logo">
    </div>

<!--</footer>-->