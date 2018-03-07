<div class="row">
    <div class="col-md-4">
        <form action="" method="POST" id="form-register">
            <label for="username">ФИО: </label>
            <input required name="name" id="username" type="text" class="form-control"><br>
            <label for="email">Email: </label>
            <input required name="email" id="email" type="email" class="form-control"><br>

            <label for="region_select">Выберите регион: </label><br>
            <select id="region_select" name="region_select" onselect="" class="chosen-select">
                 <option value="" selected >Выберите регион</option>
                <?php
                foreach ($region as $data) {
                    echo "<option value =" . $data['region_id'] . ">" . $data['region_name'] . " </option>";
                } ?>
            </select>
            <br>

            <div class="show_city">
                <label for="city_select" id="city_select_label">Выберите город: </label><br>
                <select id="city_select" name="city_select" onselect="" class="chosen-select">
                    <option value="" selected >Выберите город</option>
                </select>
            </div>

            <div class="show_dist">
                <label for="dist_select" id="dist_select_label">Выберите район: </label><br>
                <select id="dist_select" name="dist_select" onselect="" class="chosen-select" data-placeholder="Выберите район">
                    <option value="" selected >Выберите район</option>
                </select>
            </div>
            <input name="submit" id="reg" type="submit" value="Регистрация" class="btn btn-default">
        </form>
        <div class="user_info"></div>
    </div>
</div>