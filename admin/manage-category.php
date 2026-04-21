<?php include('admin-header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM categories";
                $res = mysqli_query($conn, $sql);
                $sn = 1;
                if($res && mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['name'];
                        $image_name = $row['image_name'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php 
                                    if($image_name != "") {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>assets/images/category/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    } else {
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5"><div class="error">No Category Added.</div></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<?php include('admin-footer.php'); ?>
