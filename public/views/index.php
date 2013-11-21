        <div class="article">
            <div class="article-title">
                <h3>Search</h3>
            </div>

            <div class="article-content">
                <div class="content top">
                    <form action="<?php echo PATH_TO_PUBLIC; ?>/index" method="get">
                        <input type="text" value="" name="search"  placeholder="search" />
                        <input type="submit" value="search" />
                    </form>
                </div>
            </div>
        </div>

        <?php if(!empty($contacts)) { ?>
            <div class="article">
                <div class="article-title">
                    <h3>Contact</h3>
                </div>

                <div class="article-content">
                    <div class="content top">
                        <table class="contacts rounded">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Type</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($contacts as $contact) { ?>
                                    <tr>
                                        <td><?php echo $contact['id']; ?></td>
                                        <td><?php echo ucfirst($contact['first_name']); ?></td>
                                        <td><?php echo ucfirst($contact['last_name']); ?></td>
                                        <td><?php echo ucwords($contact['type']); ?></td>
                                        <td class="table-icon"><a href="<?php echo PATH_TO_PUBLIC; ?>/index?contact=<?php echo $contact['id']; ?>"><img src="<?php echo PATH_TO_PUBLIC; ?>/static/img/icons/icon-eye-16x16.png" alt="view" /></a></td>
                                        <td class="table-icon"><a href="<?php echo PATH_TO_PUBLIC; ?>/manage-contacts?contact=<?php echo $contact['id']; ?>"><img src="<?php echo PATH_TO_PUBLIC; ?>/static/img/icons/icon-edit-16x16.png" alt="edit" /></a></td>
                                        <td><a href="<?php echo PATH_TO_PUBLIC; ?>/index?delete=<?php echo $contact['id']; ?>&sessid=<?php echo $_SESSION['token']['quick_edit']; ?>" onclick="return confirm('Are you sure?');"><img src="<?php echo PATH_TO_PUBLIC; ?>/static/img/icons/icon-delete-16x16.png" alt="delete" /></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="article">
                <div class="article-title">
                    <h3>Sorry</h3>
                </div>

                <div class="article-content">
                    <div class="content top">
                        <p>No contacts found.</p>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if(!empty($userInfo)) { ?>
            <div class="article">
                <div class="article-title">
                    <h3>
                        Address
                        <img src="<?php echo PATH_TO_PUBLIC; ?>/static/img/icons/icon-edit-32x32.png" alt="edit" />
                    </h3>
                </div>

                <div class="article-content">
                    <div class="content top" id="contact-address">
                        <form action="<?php echo PATH_TO_PUBLIC; ?>/index" method="post" id="quick-edit">
                            <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>" />
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']['quick_edit']; ?>" />
                            <p rel="street_1"><strong>Address one:</strong> <span><?php echo setChecker($userInfo['street_1']); ?></span></p>
                            <p rel="street_2"><strong>Address two:</strong> <span><?php echo setChecker($userInfo['street_2']); ?></span></p>
                            <p rel="city"><strong>City:</strong> <span><?php echo setChecker($userInfo['city']); ?></span></p>
                            <p rel="county_state"><strong>County/State:</strong> <span><?php echo setChecker($userInfo['county_state']); ?></span></p>
                            <p rel="zip_post_code"><strong>Zip/Post Code:</strong> <span><?php echo setChecker($userInfo['zip_post_code']); ?></span></p>
                            <p rel="country"><strong>Country:</strong> <span><?php echo setChecker($userInfo['country']); ?></span></p>
                            <p rel="home_tel"><strong>Home phone:</strong> <span><?php echo setChecker($userInfo['home_tel']); ?></span></p>
                            <p rel="mobile_tel"><strong>Mobile phone:</strong> <span><?php echo setChecker($userInfo['mobile_tel']); ?></span></p>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>