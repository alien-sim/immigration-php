<div class="tab-pane fade my-4 row" id="nav-school" role="tabpanel" aria-labelledby="nav-school-tab">
    <?php
        $schools = "SELECT * from `schools`";
        $school_result = $db->query($schools);
        while($school_row = $school_result->fetch_assoc()) {
            ?>
            <a href="school_detail.php?id=<?php echo $school_row['id'] ?>" target="_blank">
            <div class="col-md-4 float-left school-card">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="../media/logos/<?php echo $school_row['school_logo'] ?>">
                        <h6 class="card-text  mb-4"><?php echo $school_row['school_name'] ?></h6>
                        <p class="card-text"><small class="text-muted"><?php echo $school_row['city'] ?></small></p>
                    </div>
                </div>
            </div>
            </a>
            <?php
        }
    ?>
</div>