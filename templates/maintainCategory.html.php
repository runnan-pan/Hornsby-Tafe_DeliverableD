<h2>ADD or EDIT caterogy</h2>

<table>
    <?php foreach ($categoryRows as $row):?>
    <tr>       
        <td>
            <?php if (isset($_GET["cateId"]) && $_GET["cateId"]==$row["categoryId"] && isset($_GET["action"]) && $_GET["action"]=="edit"):?>
            <form action="maintainCategory.php" method="POST">
                <input type="text" name="categoryName" value="<?=$row["categoryName"]?>">
                <input type="hidden" name="categoryId" value="<?=$row["categoryId"]?>">
                <input type="submit" name="updateCategoryName" value="Update">
                <button type="submit" formaction="maintainCategory.php">Cancel</button>
            </form>

            <?php else:?>
            <?=$row["categoryName"]?>
            <?php endif ?>
        </td>
        <td>
            <?php if (isset($_GET["cateId"]) && $_GET["cateId"]==$row["categoryId"] && isset($_GET["action"]) && $_GET["action"]=="edit"):?>
            <div></div>
            <?php else:?>    
            <a href="maintainCategory.php?cateId=<?=$row["categoryId"]?>&action=edit">edit</a>
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach ?>

    <tr>
        <td>
            <?php if (isset($_GET["action"]) && $_GET["action"]=="addNewCategory"):?>
                <form action="maintainCategory.php" method="POST">
                    <input type="text" placeholder="Category name" name="newCategory" value="">
                    <button type="submit" name="addNewCategory">Add</button>
                    <button type="submit">Cancel</button>
                </form>

            <?php else:?>
                <a href="maintainCategory.php?action=addNewCategory">
                Add new category
                </a>
            <?php endif ?>
        </td>
    </tr>
</table>
