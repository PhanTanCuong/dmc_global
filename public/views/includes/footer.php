<?php
if (mysqli_num_rows($data["bg_footer"]) > 0):
    while ($rows = mysqli_fetch_array($data["bg_footer"])):
        $footer_bg = $rows["image"];
        $image_footer_path = "/dmc_global/public/images/" . $footer_bg;
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . $image_footer_path)):
            ?>
            <footer style="background:url(<?= $image_footer_path ?>)no-repeat center/cover;">
                <div class="container-footer">
                    <div class="footer-content">
                        <div class="footer-logo">
                            <?php
                            if (mysqli_num_rows($data["footer_icon"]) > 0):
                                while ($rows = mysqli_fetch_array($data["footer_icon"])):
                                    $footer_icon = $rows["image"];
                                    $path = "/dmc_global/public/images/" . $footer_icon;
                                    if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path)): ?>
                                        <img src="<?= $path ?>" class="img-fluid">
                                        <?php
                                    endif;
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <div class="footer-info">
                            <?php
                            $titles = [];
                            $descriptions = [];
                            $links = [];
                            // Fetch all rows from the result
                            while ($row = mysqli_fetch_array($data["footer_data"])) {
                                $titles[] = $row["title"];
                                $descriptions[] = $row["description"];
                                if ($row["json_data"] !== 'null') {
                                    $links[] = json_decode($row["json_data"], true);
                                }
                            } ?>
                            <h3 class="footer-title">
                                <?= $titles[0] ?>
                                <p class="underline-footer"></p>
                            </h3>

                            <p><?= $descriptions[0] ?></p>
                            <h3 class="footer-title">
                                <?= $titles[1] ?>
                                <p class="underline-footer"></p>
                            </h3>
                            <p><?= $descriptions[1] ?></p>
                            <?php
                            if (mysqli_num_rows($data["icons"]) > 0):
                                while ($rows = mysqli_fetch_array($data["icons"])):
                                    ?>
                                    <span><img src="/dmc_global/public/images/<?= $rows["image"] ?>"></span>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                            <p><?= $descriptions[6] ?></p>

                        </div>
                        <div class="footer-links">
                            <h3 class="footer-title">
                                <?= $titles[2]; ?>
                                <p class="underline-footer"></p>
                            </h3>
                            <ul id="product-category">
                                <?php foreach ($links[0] as $category): ?>
                                    <li><a href="#<?= $category["id"]; ?>"><?= $category["name"]; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="footer-links">
                            <h3 class="footer-title">
                                <?= $titles[3] ?>
                                <p class="underline-footer"></p>
                            </h3>
                            <ul>
                                <?php foreach ($links[1] as $quickLink): ?>
                                    <li><a href="#<?= $quickLink["id"]; ?>"><?= $quickLink["name"]; ?></a></li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                        <div class="footer-phone">
                            <h3 class="footer-title">
                                <?= $titles[5] ?>
                                <p class="underline-footer"></p>
                            </h3>

                            <p><?= $descriptions[5] ?></p>
                            <div id="phone">
                                <ul>
                                    <?php
                                    if (mysqli_num_rows($data["phone_icon"]) > 0):
                                        while ($rows = mysqli_fetch_array($data["phone_icon"])):
                                            ?>
                                            <li><img src="/dmc_global/public/images/<?= $rows["image"] ?>" class="img-fluid"></li>
                                            <?php
                                        endwhile;
                                    endif;
                                    ?>
                                    <li>
                                        <h3 class="phone-title"><?= $titles[4] ?></h3>
                                        <p><?= $descriptions[4] ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            </footer>
            <?php
        endif;
    endwhile;
endif;

?>
</body>