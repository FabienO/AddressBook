<div class="article">
    <div class="article-title">
        <h3>Contact</h3>
    </div>

    <div class="article-content">
        <div class="content top">
            <?php if(isset($errors) && $errors != '') { ?>
                <p class="error"><?php echo $errors; ?></p>
            <?php } ?>

            <form method="post" action="" id="new-contact">
                <?php if($page_title == 'Amend Contact') { ?>
                    <input type="hidden" name="contact_id" value="<?php echo isset($contact_id) ? $contact_id : ''; ?>" />
                <?php } ?>

                <label for="first_name">First name: </label>
                <input type="text" name="contacts[first_name]" value="<?php echo isset($first_name) ? $first_name : ''; ?>" />

                <label for="last_name">Last name: </label>
                <input type="text" name="contacts[last_name]" value="<?php echo isset($last_name) ? $last_name : ''; ?>" />

                <label for="type">Type: </label>
                <select name="contacts[type]" id="type">
                    <option>Choose type:</option>
                    <?php foreach($types as $t) { ?>
                        <option <?php echo isset($type) && $type == $t ? 'selected' : ''; ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
                    <?php } ?>
                    <option value="new-type" id="new-type-option">New type</option>
                </select>

                <div class="hidden" id="new-type">
                    <label for="contacts[new_type]">New type: </label>
                    <input type="text" name="contacts[new_type]" value="<?php echo isset($new_type) ? $new_type : ''; ?>" />
                </div>

                <div id="known-addresses">
                    <label for="street_1">Address line one: </label>
                    <input type="text" name="contact_info[street_1]" value="<?php echo isset($street_1) ? $street_1 : ''; ?>" />

                    <label for="street_2">Address line two: </label>
                    <input type="text" name="contact_info[street_2]" value="<?php echo isset($street_2) ? $street_2 : ''; ?>" />

                    <label for="city">City: </label>
                    <input type="text" name="contact_info[city]" value="<?php echo isset($city) ? $city : ''; ?>" />

                    <label for="county_state">County/State: </label>
                    <input type="text" name="contact_info[county_state]" value="<?php echo isset($county_state) ? $county_state : ''; ?>" />

                    <label for="zip_post_code">Zip/Postal Code: </label>
                    <input type="text" name="contact_info[zip_post_code]" value="<?php echo isset($zip_post_code) ? $zip_post_code : ''; ?>" />

                    <label for="country">Country: </label>
                    <input type="text" name="contact_info[country]" value="<?php echo isset($country) ? $country : ''; ?>" />

                    <label for="home_tel">Home phone number: </label>
                    <input type="text" name="contact_info[home_tel]" value="<?php echo isset($home_tel) ? $home_tel : ''; ?>" />

                    <label for="mobile_tel">Mobile telephone number: </label>
                    <input type="text" name="contact_info[mobile_tel]" value="<?php echo isset($mobile_tel) ? $mobile_tel : ''; ?>" />
                </div>

                <label for="submit"></label>
                <input type="submit" value="Submit" id="submit" />
            </form>
        </div>
    </div>
</div>