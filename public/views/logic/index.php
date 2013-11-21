<?php
$page_title = 'Hello world';
$js_inc = array('index');

if(!isset($_SESSION['token']['quick_edit'])) {
    $_SESSION['token']['quick_edit'] = sha1(uniqid(rand(), TRUE));
}

if(!empty($_GET['delete']) && $_GET['sessid'] == $_SESSION['token']['quick_edit']) {
    $contact = new \Classes\Model\Contacts();
    $contact->delete($_GET['delete']);

    header("Location: index");
}

if(!empty($_POST) && $_POST['token'] == $_SESSION['token']['quick_edit']) {
    $contact = new \Classes\Model\Contacts();
    foreach($_POST as $field => $data) {
        if(in_array($field, array('contact_id', 'token'))) {
            continue;
        }

        $contact->quickEdit($_POST['contact_id'], $field, $data);
    }

    die(json_encode($contact->getContactInfo($_POST['contact_id'])));
}

if(isset($_GET['search'])    && $_GET['search'] != '') {
    $contact = new \Classes\Model\Contacts();
    $contacts = $contact->search($_GET['search']);
} elseif(isset($_GET['contact']) && $_GET['contact'] > 0) {
    $contact_id = $_GET['contact'];
    $contact = new \Classes\Model\Contacts();

    $user = $contact->getContact($_GET['contact']);
    $userInfo = $contact->getContactInfo($_GET['contact']);

    $contacts = array();
    $contacts[] = $user;
} else {
    $contacts = $db->GetRows("SELECT * FROM contacts");
}
