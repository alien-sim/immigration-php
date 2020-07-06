<div class="tab-pane fade" id="nav-program" role="tabpanel" aria-labelledby="nav-program-tab">
<?php
        $schools = "SELECT * from `schools`";
        $school_result = $db->query($schools);
        while($school_row = $school_result->fetch_assoc()) {
            ?>
                <!-- college div -->
                <div class="col-md-12 card school-program-card">
                    <div class="row  d-flex align-items-center justify-content-center py-2">
                        <!-- <div class="col-md-1 text-center"> -->
                            <img src="../media/logos/<?php echo $school_row['school_logo'] ?>">
                        <!-- </div>
                        <div class="col-md-11"> -->
                            <label><?php echo $school_row['school_name'] ?></label>
                        <!-- </div> -->
                    </div>
                    
                    <?php
                        $progarm = "SELECT * from `programs` where school_id=".$school_row['id'];
                        $progarm_result = $db->query($progarm);
                        while($program_row = $progarm_result->fetch_assoc()) {
                            ?>
                            <a href="program_detail.php?id=<?php echo $program_row['id'] ?>" target="_blank">
                                <div class="col-md-12 program-card text-center py-2">
                                    
                                    <h6><i class="fa fa-graduation-cap"></i> <?php echo $program_row['program_name'] ?></h6>
                                </div>
                            </a>
                            <?php
                        }
                    ?>
                </div>
                <!-- college div end -->
            <?php
        }
    ?>
</div>