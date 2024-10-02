<style>
    .pagination {
        align-self: center;
        gap:.5rem;
    }

    .page-item>a{
        color: #000;
    }
</style>
<main>
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-9 col-12 services">
                <div class="grid-container flex-column">
                    <!-- Card 1 -->
                    <div class="card flex-row">
                        <div class="service_image col-4"> <img src="image1.jpg" alt="Image 1">
                        </div>
                        <div class="service_content col-8">
                            <div class="service_text">
                                <h3>Offshore Company Formation in Dubai, RAK, UAE</h3>
                                <a href="#" class="btn btn-fill-line border-2 btn-xs rounded-0"></a>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for other cards -->
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#" id="prev-page">&lt;</a></li>
                            <li class="page-item"><a class="page-link" href="#" id="page-1">1</a></li>
                            <li class="page-item"><a class="page-link" href="#" id="page-2">2</a></li>
                            <li class="page-item"><a class="page-link" href="#" id="page-3">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" id="next-page">&gt;</a></li>
                        </ul>
                </div>
            </div>
            <?php include('partials/sideBar.php') ?>

        </div>
    </div>
</main>