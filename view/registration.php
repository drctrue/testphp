<div class="row">
    <div class="col-md-4">
        <form action="" method="POST" id="form-register">
            <label for="username">Логин: </label>
            <input required name="username" id="username" type="text" class="form-control"><br>
            <label for="email">Email: </label>
            <input required name="email" id="email" type="email" class="form-control"><br>

            <label for="region_select">Выберите регион: </label><br>
            <select id="region_select" name="region_select" onselect="" class="chosen-select">
                <?php
                foreach ($region as $data) {
                    echo "<option value =" . $data['region_id'] . ">" . $data['region_name'] . " </option>";
                } ?>
            </select>
            <br>

            <div id="show_city"></div>
            <div id="show_dist"></div>
            <input name="submit" id="reg" type="submit" value="Регистрация" class="btn btn-default">
        </form>
        <div class="user_info"></div>
    </div>
</div>


