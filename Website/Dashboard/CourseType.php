<div class="container">
    <form action="" method="post">
        <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
            <input type="button" name="add" id="add" value="Add Course Category" onclick="openModal()">
            <div>
                <input type="text" name="search" id="search" placeholder="Search CourseCategory">
                <input type="submit" name="searchsub" id="searchsub" value="Search">
            </div>
        </div>
        <table class="table table-striped">
            <tr>
                <td>CategoryID</td>
                <td>CategoryName</td>
                <td>Operating</td>
            </tr>
            <?php
            include '../ConnectDB.php';
            if (empty($_POST['searchsub'])) {
                $res = mysqli_query($conn, "SELECT * FROM coursecategory ORDER BY CategoryID");
            } else {
                $sel = $_POST['search'];
                $res = mysqli_query($conn, "SELECT * FROM coursecategory WHERE CategoryID LIKE '%$sel%' OR CategoryName LIKE '%$sel%'");
            }

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>$row[0]</td> <td>$row[1]</td>
                            <td>
                                <input type='submit' name='upsub$row[0]' id='upsub$row[0]' value='Edit' style='background-color: gray; border: none; color: white;'>
                                <input type='submit' name='delsub$row[0]' id='delsub$row[0]' value='Delete' onclick='' style='background-color: red; border: none; color: white;'>
                            </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</div>
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Course Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center; padding: 10px">
                <form id="addCategoryForm">
                    <input type="text" name="categoryName" id="categoryName" placeholder="Category Name">
                    <button type="submit" class="btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>