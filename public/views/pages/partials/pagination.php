<style>
    /* Pagination container styling */
    .pagination {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* Pagination links */
    .pagination .page-link {
        color: #b4171b;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
        margin: 0 5px;
        transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
        position: relative;
    }

    /* Add hover effect */
    .pagination .page-link:hover {
        background-color: #b4171b;
        color: white;
        transform: translateY(-3px);
        /* Add a little 'lift' effect on hover */
    }

    /* Active page styling */
    .pagination .page-item.active .page-link {
        background-color: #b4171b;
        color: white;
        border-color: #b4171b;
        transform: scale(1.1);
        /* Slightly enlarge the active page */
    }

    /* Disabled page styling */
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #e9ecef;
        border-color: #dee2e6;
        cursor: not-allowed;
    }

    /* Add a subtle shadow to make buttons feel clickable */
    .pagination .page-link {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Animation effect for hover (optional) */
    .pagination .page-link::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: transparent;
        transition: background-color 0.3s ease;
    }

    .pagination .page-link:hover::after {
        background-color: white;
        /* Create underline effect on hover */
    }

    /* Style for disabled buttons */
    .pagination .page-item.disabled .page-link {
        pointer-events: none;
        opacity: 0.6;
    }

    /* Active page styling */
    .pagination .page-item.active .page-link {
        background-color: #b4171b !important;
        border-color: #000 !important;
        color: white !important;
        transform: scale(1.05);
        /* Slightly enlarge the active page */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Add shadow to active item */
    }

    /* Hover effect for active page (optional, if needed) */
    .pagination .page-item.active .page-link:hover {
        background-color: #a01418 !important;
        /* Darker shade on hover */
        border-color: #333 !important;
        transform: scale(1.07);
        /* Slightly more enlarge on hover */
    }
</style>
<ul class="pagination justify-content-center">
    <?php $count = (int) $data['total_page'] ?>
    <?php $page = (int) $data['current_page'] ?>
    <!-- Nút Previous -->
    <li class="page-item <?= ($page > 1) ? '' : 'disabled' ?>">
        <a class="page-link" href="<?= $_ENV['BASE_URL'] . '/business-services?page=' . $data['previous_page'] ?>"
            id="prev-page">&lt;</a>
    </li>

    <!-- Số trang -->

    <?php for ($i = 1; $i <= $count; $i++): ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="<?= $_ENV['BASE_URL'] . '/business-services?page=' . $i ?>"
                id="page-<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endfor; ?>

    <!-- Nút Next -->
    <li class="page-item <?= ($page < $count) ? '' : 'disabled' ?>">
        <a class="page-link" href="<?= $_ENV['BASE_URL'] . '/business-services?page=' . $data['next_page'] ?>"
            id="next-page">&gt;</a>
    </li>
</ul>