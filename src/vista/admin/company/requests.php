<?php require_once 'src/vista/admin/partials/estructure.php'; ?>

<div class="page-container">
    <h1 class="page-title">Company Requests</h1>
        <form action="index.php?c=admin&m=filterRequests" method="post" class="filter-form">
        <label for="filter">Filter by status: </label>
        <select name="filter" id="filter" class="filter-select">
            <option value="all">All</option>
            <option value="Approved">Accepted</option>
            <option value="Rejected">Denied</option>
            <option value="pending">Pending</option>
        </select>
        <input type="submit" value="Filter" class="filter-button">
    </form>
    <?php if(isset($datos['actualFilter'])):?>
        <?php if($datos['actualFilter'] == "all"):?>
            <h2>Todas las solicitudes</h2>
        <?php endif?>
        <?php if($datos['actualFilter'] == "Approved"):?>
            <h2>Solicitudes Aprobadas</h2>
        <?php endif?>
        <?php if($datos['actualFilter'] == "pending"):?>
            <h2>Solicitudes Pendientes</h2>
        <?php endif?>
        <?php if($datos['actualFilter'] == "Rejected"):?>
            <h2>Solicitudes Denegadas</h2>
        <?php endif?>
    <?php endif?>

            <div class="cards-container">
                
    <?php foreach ($datos['companyRequests'] as $request) : ?>
        <?php if($request['status'] == "Pending"): ?>
            <div class="request-card request-pending">
                <span class="material-symbols-outlined status-icon status-icon-pending">schedule</span>
        <?php endif?>
        <?php if($request['status'] == "Rejected"): ?>
            <div class="request-card request-rejected">
                <span class="material-symbols-outlined status-icon status-icon-rejected">cancel</span>
        <?php endif?>
        <?php if($request['status'] == "Approved"): ?>
            <div class="request-card request-approved">
            <span class="material-symbols-outlined status-icon status-icon-approved">check_circle</span>
        <?php endif?>
            <h2 class="request-title"><?= $request['companyName'] ?></h2>
            <strong><span class="material-symbols-outlined">badge</span> Contact Name </strong>
            <p><?= $request['contactName'] ?></p> 
            <strong><span class="material-symbols-outlined">mail</span> Contact Email</strong>
            <p><?= $request['contactEmail'] ?></p> 
            <strong><span class="material-symbols-outlined">phone</span> Contact Phone</strong>
            <p><?= $request['contactPhone'] ?></p> 
            <strong><span class="material-symbols-outlined">password</span> Token</strong>
            <p><?= $request['token'] ?></p> 
            <strong><span class="material-symbols-outlined">key</span> Request ID</strong>
            <p><?= $request['id'] ?></p> 
            <strong><span class="material-symbols-outlined">military_tech</span> Request Status</strong>
            <p><?= $request['status'] ?></p> 
            <strong><span class="material-symbols-outlined">chat</span> Message</strong>
            <pre> <?= $request['message'] ?></pre>

            <form action="index.php?c=admin&m=dashboardOptionRequest" method="post" class="request-form">
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
</div>

<?php require_once 'src/vista/admin/partials/endEstructure.php'; ?>