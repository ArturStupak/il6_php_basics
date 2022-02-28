<div class="wrapper">
    <table>
        <tr>
            <td>#</td>
            <td>ID</td>
            <td>Title</td>
            <td>Views</td>
            <td>Link</td>
            <td>Author</td>
            <td>Price</td>
            <td>Active</td>
            <td>action</td>
        </tr>
        <form action="<?= $this->url('admin/massadupdate')?>" method="POST">
        <?php
        /**
         * @var \Model\Ad $ad
         */
        foreach($this->data['ads'] as $ad): ?>
            <tr>
                <td><input name="ad_id[]" value ="<?php echo $ad->getId() ?>" type="checkbox"></td>
                <td><?= $ad->getId()?></td>
                <td><?= $ad->getTitle()?></td>
                <td><?= $ad->getVisitors()?></td>
                <td><?= $ad->getSlug()?></td>
                <td><?= $ad->getUserId()?></td>
                <td><?= $ad->getPrice()?></td>
                <td><?= $ad->isActive()?></td>
                <td>
                    <a href="<?= $this->url('admin/adedit', $ad->getId())?>">
                        edit
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
        <select name="active">
            <option value="1">Active all</option>
            <option value="0">Disactive all</option>
            <option value="2">Delete</option>
        </select>
        <script language="JavaScript">
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>
        <input type="checkbox" onclick="toggle(this);" />Check All<br />
        <input class="myButton" name="create" type="submit" value="update">
        </form>

</div>


