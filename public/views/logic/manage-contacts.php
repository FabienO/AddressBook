<?php
$js_inc = array('manage-contacts');
$page_title = 'Add new';

if(isset($_GET['contact']) && $_GET['contact'] > 0) {
    $contact_id = $_GET['contact'];
    $contact = new \Classes\Model\Contacts();

    $user = $contact->getContact($_GET['contact']);
    $userInfo = $contact->getContactInfo($_GET['contact']);

    extract($userInfo);
    extract($user);
    $page_title = 'Amend Contact';
}

if(!empty($_POST)) {
    // New type of contact
    if(isset($_POST['contacts']['new_type']) && $_POST['contacts']['new_type'] != '') {
        $_POST['contacts']['type'] = $_POST['contacts']['new_type'];
    }

    extract($_POST['contacts']);
    extract($_POST['contact_info']);

    unset($_POST['contacts']['new_type']);

    $contact = new \Classes\Model\Contacts();

    if(isset($_POST['contact_id']) && $_POST['contact_id'] > 0) {
        // Assign contact ID to both arrays
        $contact_id = $_POST['contacts']['id'] = $_POST['contact_info']['contact_id'] = $_POST['contact_id'];

        try {
            $contact->updateContact($_POST['contact_id'], $_POST['contacts']);
            $contact->updateContactInfo($_POST['contact_id'], $_POST['contact_info']);

            header('Location: '. PATH_TO_PUBLIC . '/index?contact='. $contact_id);
            exit();
        } catch(\Exception $e) {
            $errors = $e->getMessage();
        }
    } else {
        try {
            $contact_id = $contact->addContact($_POST['contacts']);
            $_POST['contact_info']['contact_id'] = $contact_id;
            $contact->addContactInfo($_POST['contact_info']);

            header('Location: '. PATH_TO_PUBLIC . '/index?contact='. $contact_id);
            exit();
        } catch(\Exception $e) {
            $errors = $e->getMessage();
        }
    }


}

$types = $db->GetCols("SELECT DISTINCT type FROM contacts");