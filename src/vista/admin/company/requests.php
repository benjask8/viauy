<?php require_once 'src/vista/admin/partials/estructure.php'; ?>

<div class="page-container">
    <h1 class="page-title">Company Requests</h1>

    <form action="index.php?c=admin&m=filterRequests" method="post" class="filter-form">
    <label for="filter">Filter by status:</label>
    <select name="filter" id="filter" class="filter-select">
        <option value="all">All</option>
        <option value="Approved">Accepted</option>
        <option value="Rejected">Denied</option>
        <option value="pending">Pending</option>
    </select>
    <input type="submit" value="Filter" class="filter-button">
    </form>


    <?php foreach ($datos['companyRequests'] as $request) : ?>
        <div class="request-card">
            <h2 class="request-title"><?= $request['companyName'] ?></h2>
            <p><strong>Contact Name:</strong> <?= $request['contactName'] ?></p>
            <p><strong>Contact Email:</strong> <?= $request['contactEmail'] ?></p>
            <p><strong>Contact Phone:</strong> <?= $request['contactPhone'] ?></p>
            <pre><strong>Message:</strong> <?= $request['message'] ?></pre>
            <p><strong>Request ID:</strong> <?= $request['id'] ?></p>
            <p><strong>Request Status:</strong> <?= $request['status'] ?></p>

            <form action="index.php?c=admin&m=dashboard_optionRequest" method="post" class="request-form">
                <input type="hidden" name="id" value="<?= $request['id'] ?>">
                <label for="action">Action:</label>
                <select name="action" id="action" class="action-select">
                    <option value="accept">Approve</option>
                    <option value="deny">Deny</option>
                </select>
                <input type="submit" value="Submit" class="submit-button">
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'src/vista/admin/partials/endEstructure.php'; ?>