<?php
if (mysqli_num_rows($data["bg_footer"]) > 0):
    while ($rows = mysqli_fetch_array($data["bg_footer"])):
        $footer_bg = $rows['image'];
        $image_footer_path = "/dmc_global/public/images/" . $footer_bg;
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_footer_path)):
            ?>
            <footer style="background:url(<?php echo $image_footer_path ?>)no-repeat center/cover;">
                <div class="container-footer">
                    <div class="footer-content">
                        <div class="footer-logo">
                            <?php
                            if (mysqli_num_rows($data["footer_icon"]) > 0):
                                while ($rows = mysqli_fetch_array($data["footer_icon"])):
                                    $footer_icon = $rows['image'];
                                    $path = "/dmc_global/public/images/" . $footer_icon;
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)): ?>
                                        <img src="<?php echo $path ?>" class="img-fluid">
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
                            // Fetch all rows from the result
                            while ($row = mysqli_fetch_array($data['footer_data'])) {
                                $titles[] = $row['title'];
                                $descriptions[] = $row['description'];
                            } ?>
                            <h3 class="footer-title">
                                <?php echo $titles[0] ?>
                                <p class="underline-footer"></p>
                            </h3>

                            <p><?php echo $descriptions[0] ?></p>
                            <h3 class="footer-title">
                                <?php echo $titles[1] ?>
                                <p class="underline-footer"></p>
                            </h3>
                            <p><?php echo $descriptions[1] ?></p>
                            <?php
                            if (mysqli_num_rows($data['icons']) > 0):
                                while ($rows = mysqli_fetch_array($data['icons'])):
                                    ?>
                                    <span><img src="/dmc_global/public/images/<?php echo $rows['image'] ?>"></span>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                            <p><?php echo $descriptions[6] ?></p>

                        </div>
                        <div class="footer-links">
                            <h3 class="footer-title">
                                <?php echo $titles[2]; ?>
                                <p class="underline-footer"></p>
                            </h3>
                            <ul id="product-category">
                                <?php foreach ($data['product_categories'] as $category): ?>
                                    <li><a href="#<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="footer-links">
                            <h3 class="footer-title">
                                <?php echo $titles[3] ?>
                                <p class="underline-footer"></p>
                            </h3>
                            <ul>
                                <?php foreach ($data['quick_links'] as $quickLink): ?>
                                    <li><a href="#<?php echo $quickLink['id']; ?>"><?php echo $quickLink['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                        <div class="footer-phone">
                            <h3 class="footer-title">
                                <?php echo $titles[5] ?>
                                <p class="underline-footer"></p>
                            </h3>

                            <p><?php echo $descriptions[5] ?></p>
                            <div id="phone">
                                <ul>
                                    <?php
                                    if (mysqli_num_rows($data['phone_icon']) > 0):
                                        while ($rows = mysqli_fetch_array($data['phone_icon'])):
                                            ?>
                                            <li><img src="/dmc_global/public/images/<?php echo $rows['image'] ?>" class="img-fluid"></li>
                                            <?php
                                        endwhile;
                                    endif;
                                    ?>
                                    <li>
                                        <h3 class="phone-title"><?php echo $titles[4] ?></h3>
                                        <p><?php echo $descriptions[4] ?></p>
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